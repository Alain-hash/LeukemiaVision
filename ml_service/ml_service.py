from flask import Flask, request, jsonify
from flask_cors import CORS
import os
import numpy as np
import tensorflow as tf
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
from tensorflow.keras.applications.densenet import preprocess_input

app = Flask(__name__)
CORS(app)

# Configuration
UPLOAD_FOLDER = 'uploads'
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
MODEL_PATH = 'model/DenseNet121_binary.h5'

# Load the model
print("Loading leukemia detection model...")
model = load_model(MODEL_PATH)
print("Model loaded successfully!")

def preprocess_image(img_path):
    """Preprocess an image for model prediction (matches Colab implementation)"""
    img = image.load_img(img_path, target_size=(224, 224), color_mode='rgb')
    img_array = image.img_to_array(img)
    img_array = np.expand_dims(img_array, axis=0)
    return preprocess_input(img_array)

@app.route('/analyze', methods=['POST'])
def analyze():
    """Handle image analysis request"""
    if 'image' not in request.files:
        return jsonify({'success': False, 'result': 'No file part'})
    
    file = request.files['image']
    if file.filename == '':
        return jsonify({'success': False, 'result': 'No selected file'})
    
    try:
        # Save the uploaded file
        filename = os.path.join(UPLOAD_FOLDER, file.filename)
        file.save(filename)
        
        # Process image and make prediction (matches Colab predict_single_image)
        processed_image = preprocess_image(filename)
        prediction_prob = float(model.predict(processed_image)[0][0])  # Get single probability
        
        # Determine class and confidence (matches Colab binary classification)
        predicted_class = 'Pro' if prediction_prob > 0.5 else 'Benign'
        confidence = prediction_prob * 100 if predicted_class == 'Pro' else (1 - prediction_prob) * 100
        
        # Format result message
        result_message = f"Prediction: {predicted_class}\n"
        result_message += f"Confidence: {confidence:.2f}%\n\n"
        
        if predicted_class == 'Benign':
            result_message += "Analysis: No signs of leukemia detected. The cells appear normal."
        else:
            result_message += "Analysis: Detected Pro stage leukemia cells in the blood sample."
        
        return jsonify({
            'success': True,
            'result': result_message,
            'prediction': predicted_class,
            'confidence': confidence,
            'raw_probability': prediction_prob  # For debugging
        })
    except Exception as e:
        return jsonify({'success': False, 'result': f'Error during analysis: {str(e)}'})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
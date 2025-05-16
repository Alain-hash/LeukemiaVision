import json
import random
import string
import nltk
import numpy as np
from nltk.stem import WordNetLemmatizer
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from flask import Flask, request, jsonify
from flask_cors import CORS


nltk.download('punkt', quiet=True)
nltk.download('wordnet', quiet=True)
nltk.download('omw-1.4', quiet=True)

# Initialize lemmatizer
lemmatizer = WordNetLemmatizer()

# Initialize Flask app
app = Flask(__name__)
CORS(app) 

# Load the intents file
try:
    with open('intents.json', 'r') as file:
        intents_data = json.load(file)
except FileNotFoundError:
    print("Error: intents.json file not found!")
    exit(1)

# Extract all patterns and their corresponding intents
patterns = []
tags = []
for intent in intents_data['intents']:
    for pattern in intent['patterns']:
        patterns.append(pattern)
        tags.append(intent['tag'])

# Initialize empty lists to hold corpus data
corpus_words = {}
intent_documents = {}
all_words = []

# Process intents data
for intent in intents_data['intents']:
    intent_documents[intent['tag']] = []
    for pattern in intent['patterns']:
        # Tokenize each pattern
        words = nltk.word_tokenize(pattern.lower())
        # Add words to documents for specific intent
        intent_documents[intent['tag']].extend(words)
        # Add words to all_words list
        all_words.extend(words)

# Lemmatize all words and create corpus_words dictionary
all_words = [lemmatizer.lemmatize(word.lower()) for word in all_words if word not in string.punctuation]
all_words = sorted(list(set(all_words)))

# Preprocessing function
def preprocess(text):
    """Clean and preprocess the input text"""
    # Tokenize the sentence into words
    tokens = nltk.word_tokenize(text.lower())
    
    # Remove punctuation
    tokens = [token for token in tokens if token not in string.punctuation]
    
    # Lemmatize each word (reduce to its base form)
    lemmatized_tokens = [lemmatizer.lemmatize(token) for token in tokens]
    
    return lemmatized_tokens

# Function to find the intent of the user message
def predict_intent(user_input):
    """Use cosine similarity to find the closest matching intent"""
    # Preprocess user input
    processed_input = preprocess(user_input)
    processed_input_text = ' '.join(processed_input)
    
    # If no content after preprocessing, return fallback
    if not processed_input:
        return "fallback"
    
    # Calculate similarity with each pattern
    vectorizer = CountVectorizer().fit(patterns + [processed_input_text])
    pattern_vectors = vectorizer.transform(patterns)
    input_vector = vectorizer.transform([processed_input_text])
    
    # Calculate cosine similarities
    similarities = cosine_similarity(input_vector, pattern_vectors)[0]
    
    # If all similarities are very low, return fallback
    if max(similarities) < 0.2:
        return "fallback"
    
    # Return the tag of the most similar pattern
    most_similar_index = np.argmax(similarities)
    return tags[most_similar_index]

# Get response based on intent
def get_response(intent_tag):
    """Return a random response for the matched intent"""
    for intent in intents_data['intents']:
        if intent['tag'] == intent_tag:
            return random.choice(intent['responses'])
    return random.choice(intents_data['intents'][-1]['responses'])  # Fallback response

# API endpoint for chatbot
@app.route('/chatbot.php', methods=['POST'])
def chatbot_response():
    data = request.json
    user_message = data.get('message', '').strip()
    
    if not user_message:
        return jsonify({"error": "Empty message"}), 400
    
    # Process and respond
    intent = predict_intent(user_message)
    bot_response = get_response(intent)
    
    return jsonify({"response": bot_response})

if __name__ == "__main__":
    app.run(debug=True, host='127.0.0.1', port=5000)

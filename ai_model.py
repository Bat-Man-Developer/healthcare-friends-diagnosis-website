import numpy as np
from transformers import GPT2LMHeadModel, GPT2Tokenizer
import torch
from torch.nn import functional as F
import json
import os

class Model:
    def __init__(self):
        # Initialize with GPT-2 medium for better responses
        self.tokenizer = GPT2Tokenizer.from_pretrained('gpt2-medium')
        self.model = GPT2LMHeadModel.from_pretrained('gpt2-medium')
        
        # Fix for padding token
        self.tokenizer.pad_token = self.tokenizer.eos_token
        self.model.config.pad_token_id = self.model.config.eos_token_id
        
        self.learning_rate = 1e-4
        self.optimizer = torch.optim.Adam(self.model.parameters(), lr=self.learning_rate)
        self.memory_file = 'ai_memory.json'
        self.memory = self.load_memory()

    def load_memory(self):
        if os.path.exists(self.memory_file):
            with open(self.memory_file, 'r') as f:
                try:
                    memory_data = json.load(f)
                    return memory_data.get('input', '')
                except json.JSONDecodeError:
                    return ''
        return ''

    def save_memory(self, input_text):
        with open(self.memory_file, 'w') as f:
            json.dump({'input': input_text}, f)

    def generate_response(self, input_text):
        if not input_text:
            return "No input found in memory file."
            
        self.model.eval()
        
        # Prepare a more specific prompt
        prompt = f"Please provide a detailed answer to this question: {input_text}\nDetailed answer: "
        
        encoded = self.tokenizer.encode_plus(
            prompt,
            return_tensors='pt',
            max_length=256,
            truncation=True,
            padding='max_length',
            add_special_tokens=True,
            return_attention_mask=True
        )

        with torch.no_grad():
            output_sequences = self.model.generate(
                input_ids=encoded['input_ids'],
                attention_mask=encoded['attention_mask'],
                max_length=500,
                min_length=100,
                do_sample=True,
                temperature=0.8,
                top_k=50,
                top_p=0.95,
                num_return_sequences=1,
                num_beams=5,  # Added beam search
                pad_token_id=self.tokenizer.eos_token_id,
                eos_token_id=self.tokenizer.eos_token_id,
                no_repeat_ngram_size=3,
                length_penalty=1.5
            )

        response = self.tokenizer.decode(output_sequences[0], skip_special_tokens=True)
        
        # Clean up the response
        response = response.replace(prompt, "").strip()
        #response = response.split('\n')[0]  # Take only the first paragraph if multiple are generated
        
        return response
    
def main():
    try:
        model = Model()
        
        # Get input from memory file
        user_input = model.load_memory()
        
        if not user_input:
            print("No input found in memory file.")
            return

        response = model.generate_response(user_input)
        print(f"{response}")
            
    except Exception as e:
        print(f"An error occurred: {str(e)}")

if __name__ == "__main__":
    main()
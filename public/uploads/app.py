import gradio as gr
from transformers import DistilBertTokenizer, DistilBertForSequenceClassification
import torch

# Load model
model_path = "./my_text_detector"
model = DistilBertForSequenceClassification.from_pretrained(model_path)
tokenizer = DistilBertTokenizer.from_pretrained(model_path)
model.eval()

def classify_text(text):
    inputs = tokenizer(text, return_tensors="pt", truncation=True, padding=True, max_length=512)
    with torch.no_grad():
        outputs = model(**inputs)
    logits = outputs.logits
    prediction = torch.argmax(logits, dim=1).item()
    label = "AI-Generated" if prediction == 1 else "Human-Written"
    return label

interface = gr.Interface(fn=classify_text, inputs="text", outputs="text", title="AI Text Detector")
interface.launch()

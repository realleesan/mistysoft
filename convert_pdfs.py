import os
import fitz  # PyMuPDF

DOCS = {
    'proposal': 'PROPOSAL_LMS_KOREAN_MS_B_2026_V1.0.pdf',
    'srs': 'SRS_LMS_KOREAN_MS_B_2026_V6.0.pdf',
    'qna': 'QNA_LMS_KOREAN_MS_B_2026_V5.0.pdf',
    'ats': 'ATS_LMS_KOREAN_MS_B_2026_V6.0.pdf',
    'payment': 'PAYMENT_LMS_KOREAN_MS_B_2026_V2.0.pdf',
    'contract': 'CONTRACT_LMS_KOREAN_MS_B_2026_V6.0.pdf',
    'config': 'CONFIG_LMS_KOREAN_MS_B_2026_V1.0.pdf',
    'email': 'EMAIL_LMS_KOREAN_MS_B_2026_V1.3.pdf',
    'cr': 'CR_LMS_KOREAN_MS_B_2026_V1.0.pdf',
}

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
PDF_DIR = os.path.join(BASE_DIR, 'app', 'views', 'document')
OUTPUT_DIR = os.path.join(BASE_DIR, 'public', 'assets', 'docs')

os.makedirs(OUTPUT_DIR, exist_ok=True)

# 150 DPI is standard for crisp document reading on web
zoom = 150 / 72
matrix = fitz.Matrix(zoom, zoom)

for key, filename in DOCS.items():
    pdf_path = os.path.join(PDF_DIR, filename)
    doc_output_dir = os.path.join(OUTPUT_DIR, key)
    os.makedirs(doc_output_dir, exist_ok=True)
    
    print(f"Processing {key}: {filename}...")
    doc = fitz.open(pdf_path)
    
    # Save each page as PNG
    for page_num in range(len(doc)):
        page = doc.load_page(page_num)
        pix = page.get_pixmap(matrix=matrix)
        output_file = os.path.join(doc_output_dir, f"page_{page_num + 1}.png")
        pix.save(output_file)
        
    page_count = len(doc)
    doc.close()
    print(f"Successfully converted {key} ({page_count} pages) to images in {doc_output_dir}")

print("All documents converted successfully!")

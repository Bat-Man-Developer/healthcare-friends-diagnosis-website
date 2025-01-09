// Add to script.js
document.addEventListener('DOMContentLoaded', function() {
    const diagnosisForm = document.getElementById('diagnosisForm');
    const modal = document.getElementById('diagnosisModal');
    const closeBtn = document.querySelector('.close');
    const diagnosisResults = document.getElementById('diagnosisResults');

    if (diagnosisForm) {
        diagnosisForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('process_diagnosis.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    diagnosisResults.innerHTML = generateDiagnosisHTML(data);
                    modal.style.display = 'block';
                } else {
                    alert('Error processing diagnosis. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error processing diagnosis. Please try again.');
            });
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

function generateDiagnosisHTML(data) {
    // Generate HTML for diagnosis results
    // Customize this based on your needs
    return `
        <div class="diagnosis-results">
            <h3>Based on your symptoms:</h3>
            <ul>
                ${data.data.symptoms.map(symptom => `<li>${symptom}</li>`).join('')}
            </ul>
            <p>Duration: ${data.data.duration}</p>
            <p>Severity: ${data.data.severity}</p>
            <!-- Add more result details -->
        </div>
    `;
}
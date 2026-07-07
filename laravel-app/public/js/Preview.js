'use strict';

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileWithPreview');
    const previewImg = document.getElementById('previewImg');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Check if file is an image
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                this.value = ''; // Clear the input
                return;
            }
            
            // Create a FileReader
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            
            reader.readAsDataURL(file);
        } else {
            // If no file selected, revert to default image
            previewImg.src = "/image/img-not-found.jpg";
        }
    });
});

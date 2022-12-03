import { useState } from 'react';

function checkFileFormat(file, pattern) {
    let validity = true;
    // Check file format
    if (!file.name.match(pattern)) {
        validity = false;
        return validity;
    }

    return validity;
}

function checkDataValidity(file) {}
function Home() {
    const handleFormSubmit = (e) => {
        e.preventDefault();

        if (!e.target.checkValidity()) {
            e.stopPropagation();
        }
        e.target.classList.add('was-validated');
    };
    const handleFileValidity = (e) => {
        // Get div for error display
        const error = e.target.nextElementSibling;
        // Check if file is csv or not
        if (!checkFileFormat(e.target.files[0], /\.(csv)$/i)) {
            // Set error message inside textContent of error
            error.textContent = 'Not a cssv file';
            // Set validity of this element to false so that form becomes invalid
            e.target.setCustomValidity('Error');

            return;
        }
        // Check if data is valid or not
        if (!checkDataValidity(e.target.files[0])) {
            error.textContent = 'Data format is incorrect';
            // Set validity of this element to false so that form becomes invalid
            e.target.setCustomValidity('Error');
            return;
        }

        e.target.setCustomValidity('');
    };
    return (
        <div className="bg-light text-dark p-5 text-center">
            <form
                className="needs-validation"
                id="uploadForm"
                noValidate
                onSubmit={handleFormSubmit}
            >
                <input
                    className="form-control mx-auto form-fileInput"
                    type="file"
                    onChange={handleFileValidity}
                    required
                />
                <div className="invalid-feedback" />

                <button type="submit" className="btn btn-primary my-3">
                    Upload
                </button>
            </form>
        </div>
    );
}

export default Home;

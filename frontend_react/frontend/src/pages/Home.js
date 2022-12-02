import { useState } from 'react';

function Home() {
    const handleFormSubmit = (e) => {
        e.preventDefault();

        if (!e.target.checkValidity()) {
            e.stopPropagation();
        }
        e.target.classList.add('was-validated');
    };
    const handleFileUpload = (e) => {
        e.target.setCustomValidity('');
        // Check if file is csv or not
        if (!e.target.files[0].name.match(/\.(csv)$/i)) {
            console.log('Not a csv file');

            // Set validity of this element to false so that form becomes invalid
            e.target.setCustomValidity('Must be a CSV file');
        }
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
                    className="form-control mx-auto form-fileInput "
                    type="file"
                    onChange={handleFileUpload}
                    required
                />
                <div className="invalid-feedback">Must be a CSV file!</div>
                <div className="valid-feedback">Success!</div>

                <button type="submit" className="btn btn-primary my-3">
                    Upload
                </button>
            </form>
        </div>
    );
}

export default Home;

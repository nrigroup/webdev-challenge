import { useState } from 'react';

function Home() {
    const [error, setError] = useState('');
    const handleFileUpload = (e) => {
        e.preventDefault();

        setError('');
        // Check if file is csv or not
        if (!e.target.files[0].name.match(/\.(csv)$/i)) {
            console.log('Not a csv file');
            setError('Not a csv file');
        }
    };
    return (
        <div className="bg-light text-dark p-5 text-center">
            <form>
                <input
                    className="form-control mx-auto form-fileInput "
                    type="file"
                    onChange={handleFileUpload}
                />
                <button type="submit" className="btn btn-primary my-3">
                    Upload
                </button>
            </form>

            {error ? (
                <div className="alert alert-primary" role="alert">
                    {error}
                </div>
            ) : (
                ''
            )}
        </div>
    );
}

export default Home;

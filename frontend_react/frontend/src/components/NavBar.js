import { Link } from 'react-router-dom';

function NavBar() {
    return (
        <nav className="navbar navbar-expand-md bg-dark navbar-dark py-3">
            <div className="container">
                <Link to="/" className="navbar-brand">
                    CSV Reader
                </Link>
                <button
                    className="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navmenu"
                >
                    <span className="navbar-toggler-icon" />
                </button>
                <div className="collapse navbar-collapse" id="navmenu">
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item">
                            <Link to="/" className="nav-link">
                                Home
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}

export default NavBar;

import './scss/styles';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from './pages/Home';
import Analytics from './pages/Analytics';
import NavBar from './components/NavBar';
import { DataProvider } from './contexts/DataContext';
import PrivateRoute from './components/PrivateRoute';

function App() {
    return (
        <div className="App">
            <BrowserRouter>
                <NavBar />
                <DataProvider>
                    <Routes>
                        {/* Home Page */}
                        <Route exact path="/" element={<Home />} />

                        {/* Analytics Page */}
                        {/* This private route ensures that analytics page is displayed only when data is available */}
                        {/* Otherwise redirect to home page */}
                        <Route exact path="/show" element={<PrivateRoute />}>
                            <Route exact path="/show" element={<Analytics />} />
                        </Route>
                    </Routes>
                </DataProvider>
            </BrowserRouter>
        </div>
    );
}

export default App;

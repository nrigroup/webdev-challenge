import './scss/styles';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from './pages/Home';
import Analytics from './pages/Analytics';
import NavBar from './components/NavBar';
import { DataProvider } from './contexts/DataContext';

function App() {
    return (
        <div className="App">
            <BrowserRouter>
                <NavBar />
                <DataProvider>
                    <Routes>
                        <Route exact path="/" element={<Home />} />
                        <Route exact path="/show" element={<Analytics />} />
                    </Routes>
                </DataProvider>
            </BrowserRouter>
        </div>
    );
}

export default App;

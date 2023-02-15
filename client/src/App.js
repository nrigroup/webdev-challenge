import Container from "react-bootstrap/Container";
import Header from "./components/Header";
import Home from "./pages/Home";
import "bootstrap/dist/css/bootstrap.min.css";

function App() {
  return (
    <>
      <Header />
      <main>
        <Container>
          <Home />
        </Container>
      </main>
    </>
  );
}

export default App;

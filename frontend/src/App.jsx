import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";
import Home from "./pages/Home";
import About from "./pages/About";
import FacilitiesPage from "./pages/FacilitiesPage";
import GalleryPage from "./pages/galleryPage";
import LocationPage from "./pages/lokasi/lokasiTempat";
import AlumniPage from "./pages/alumniPage";
import ScrollToTop from "./components/ScrollToTop"; // Pastikan untuk import ScrollToTop

const App = () => {
  return (
    <Router>
      <ScrollToTop /> {/* Tambahkan komponen ScrollToTop */}
      <div className="font-sans flex flex-col min-h-screen bg-gray-50">
        <Navbar />
        <main className="flex-grow pt-16 pb-10"> {/* pt-16 matches navbar height */}
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/facilities" element={<FacilitiesPage />} />
            <Route path="/gallery" element={<GalleryPage />} />
            <Route path="/location" element={<LocationPage />} />
            <Route path="/alumni" element={<AlumniPage />} />
          </Routes>
        </main>
        <Footer />
      </div>
    </Router>
  );
};

export default App;

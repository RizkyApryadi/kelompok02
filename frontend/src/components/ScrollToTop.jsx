// src/components/ScrollToTop.jsx
import { useEffect } from "react";
import { useLocation } from "react-router-dom";

const ScrollToTop = () => {
  const location = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0); // Scroll ke atas setiap kali lokasi berubah
  }, [location]);

  return null;
};

export default ScrollToTop;

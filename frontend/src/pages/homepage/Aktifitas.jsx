import { useEffect, useState } from "react";
import AOS from "aos";
import "aos/dist/aos.css";
import axios from "axios";

const Aktifitas = () => {
  const [aktivitas, setAktivitas] = useState([]);

  useEffect(() => {
    AOS.init({
      duration: 1000,
      easing: 'ease-out',
      once: false,
    });

    const handleScroll = () => {
      AOS.refresh();
    };

    window.addEventListener("scroll", handleScroll);
    window.addEventListener("resize", handleScroll);

    // Fetch data aktivitas dari API Laravel
    axios.get('http://localhost:8000/api/aktivitas')
      .then(response => {
        setAktivitas(response.data);
      })
      .catch(error => {
        console.error("Error fetching aktivitas:", error);
      });

    return () => {
      window.removeEventListener("scroll", handleScroll);
      window.removeEventListener("resize", handleScroll);
    };
  }, []);

  return (
    <section className="bg-gray-100 py-12">
      <div className="container mx-auto px-6 mt-6">
        <h2 className="text-2xl font-bold text-black">Giat Civitas Akademik</h2>
      </div>

      {/* Grid Gallery */}
      <div className="container mx-auto px-6 mt-6">
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          {aktivitas.map((item) => (
            <div
              key={item.id}
              className="flex flex-col bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transition-transform duration-300"
              data-aos="fade-right"
            >
              <div className="flex-shrink-0">
                <img
                  src={`http://localhost:8000/storage/${item.gambar}`}
                  alt={item.judul}
                  className="w-full h-48 object-cover"
                />
              </div>
              <div className="flex-1 p-4 flex flex-col justify-between">
                <div>
                  <h3 className="font-semibold text-lg text-black mb-2">{item.judul}</h3>
                  <p className="text-sm text-gray-600">{item.deskripsi}</p>
                </div>
                <p className="text-xs text-gray-500 mt-4">{new Date(item.tanggal).toLocaleDateString()}</p>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Tombol More */}
      <div className="container mx-auto px-6 mt-6 text-right">
        <button className="text-yellow-500 font-semibold hover:text-yellow-600 transition">
          More →
        </button>
      </div>
    </section>
  );
};

export default Aktifitas;

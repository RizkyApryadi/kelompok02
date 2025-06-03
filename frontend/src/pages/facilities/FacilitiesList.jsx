import React, { useState, useEffect } from "react";
import axios from "axios";
import AOS from "aos";
import "aos/dist/aos.css";

const Facilities = () => {
    const [fasilitas, setFasilitas] = useState([]);
    const [current, setCurrent] = useState(null);

    useEffect(() => {
        // Init AOS animation
        AOS.init({ duration: 800, once: true });

        // Fetch data from API
        axios
            .get("http://localhost:8000/api/fasilitas")
            .then((response) => {
                setFasilitas(response.data);
                if (response.data.length > 0) {
                    setCurrent(response.data[0]);
                }
            })
            .catch((error) => {
                console.error("Gagal memuat data fasilitas:", error);
            });
    }, []);

    // Re-init AOS when current changes (for animation replay)
    useEffect(() => {
        AOS.refresh();
    }, [current]);

    return (
        <div className="w-full bg-white">
            {/* Header */}
            <div className="py-6 px-8">
                <div className="flex justify-between items-center mb-8">
                    <h2 className="text-2xl font-bold">Our Facilities :</h2>
                </div>

                {/* Tampilan utama fasilitas yang dipilih */}
                {current && (
                    <div
                        className="rounded-md overflow-hidden shadow"
                        data-aos="zoom-in"
                        key={current.id} // trigger animation on change
                    >
                        <img
                            src={`http://localhost:8000/storage/${current.foto}`}
                            alt={current.nama}
                            className="w-full h-96 object-cover"
                        />
                        <div className="p-4">
                            <h3 className="text-xl font-semibold mb-2">
                                {current.nama}
                            </h3>
                            <p className="text-gray-600 text-sm">
                                {current.deskripsi}
                            </p>
                        </div>
                    </div>
                )}
            </div>

            {/* List semua fasilitas sebagai pilihan */}
            <div className="w-full bg-gray-50 p-4">
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {fasilitas.map((item) => (
                        <div
                            key={item.id}
                            className="bg-white rounded-lg overflow-hidden shadow-sm cursor-pointer hover:shadow-md transition"
                            onClick={() => setCurrent(item)}
                            data-aos="fade-up"
                        >
                            <div className="h-48 overflow-hidden">
                                <img
                                    src={`http://localhost:8000/storage/${item.foto}`}
                                    alt={item.nama}
                                    className="w-full h-full object-cover"
                                />
                            </div>
                            <div className="p-4">
                                <h3 className="text-lg font-semibold mb-2">
                                    {item.nama}
                                </h3>
                                {/* <p className="text-gray-600 text-sm mb-4">
                                    {item.deskripsi.length > 80
                                        ? item.deskripsi.substring(0, 80) +
                                          "..."
                                        : item.deskripsi}
                                </p> */}
                                <button className="text-green-500 text-sm font-medium">
                                    Klik di sini
                                </button>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default Facilities;

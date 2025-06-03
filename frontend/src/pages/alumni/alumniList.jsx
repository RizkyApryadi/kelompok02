import { useState, useEffect } from "react";
import axios from "axios";

const AlumniList = () => {
    const [alumnis, setAlumnis] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    // Ambil data alumni dari API saat komponen dimuat
    useEffect(() => {
        axios
            .get("http://localhost:8000/api/alumni") // Sesuaikan URL dengan domain dan port API Anda
            .then((response) => {
                setAlumnis(response.data); // Set data alumni
                setLoading(false); // Set loading menjadi false setelah data diambil
            })
            .catch((error) => {
                setError("Terjadi kesalahan saat memuat data alumni.");
                setLoading(false);
            });
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>{error}</div>;
    }

    return (
        <div className="bg-gray-50 py-12">
            <div className="container mx-auto px-4 sm:px-6">
                {/* Header with filter options */}
                <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 className="text-2xl md:text-3xl font-bold text-gray-800">
                            Penasaran terkait lulusan SMAN 1 PARMAKSIAN?
                        </h2>
                        <h3 className="text-gray-600 mt-1">
                            Yuk jelajahi lulusan kami
                        </h3>
                    </div>
                </div>

                {/* Alumni Grid - Dynamic Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {alumnis.map((alumni) => (
                        <div
                            key={alumni.id}
                            className="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300"
                        >
                            <div className="relative h-40 overflow-hidden">
                                <img
                                    src={`http://localhost:8000/storage/foto_alumni/${alumni.foto}`}
                                    alt={alumni.nama}
                                    className="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                    loading="lazy"
                                />
                            </div>
                            <div className="p-6">
                                <h3 className="text-xl font-bold text-gray-800 mb-1">
                                    {alumni.nama}
                                </h3>
                                <p className="text-gray-500 text-sm">
                                    Angkatan {alumni.angkatan}
                                </p>
                                <p className="text-gray-600 mt-2">
                                    {alumni.keterangan}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default AlumniList;

import {
    FaMapMarkerAlt,
    FaPhone,
    FaEnvelope,
    FaBus,
    FaCar,
    FaSubway,
} from "react-icons/fa";

const LocationPage = () => {
    return (
        <div className="min-h-[calc(100vh-140px)] bg-gray-50">
            {/* Hero Section */}
            <div className="relative bg-blue-800 text-white py-20">
                <div className="container mx-auto px-4 text-center">
                    <h1 className="text-4xl md:text-5xl font-bold mb-4">
                        Lokasi Sekolah
                    </h1>
                    <p className="text-xl max-w-2xl mx-auto">
                        Temukan lokasi SMAN 1 Parmaksian dengan mudah
                    </p>
                </div>
            </div>

            {/* Main Content */}
            <div className="container mx-auto px-4 py-12">
                <div className="flex flex-col lg:flex-row gap-8">
                    {/* Map Section */}
                    <div className="lg:w-2/3">
                        <h2 className="text-2xl font-bold mb-6 flex items-center">
                            <FaMapMarkerAlt className="mr-2 text-red-500" />
                            Peta Lokasi
                        </h2>

                        {/* Interactive Map - Replace with your actual map embed */}
                        <div className="bg-white rounded-xl shadow-lg overflow-hidden h-96">
                            <iframe
                                src="https://maps.google.com/maps?q=2.4516691,99.183325&z=18&output=embed"
                                width="100%"
                                height="100%"
                                style={{ border: 0 }}
                                allowFullScreen=""
                                loading="lazy"
                                referrerPolicy="no-referrer-when-downgrade"
                                className="rounded-xl"
                            ></iframe>
                        </div>
                    </div>

                    {/* Contact Information */}
                    <div className="lg:w-1/3">
                        <div className="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                            <h2 className="text-2xl font-bold mb-6">
                                Kontak & Alamat
                            </h2>

                            <div className="space-y-5">
                                <div className="flex items-start">
                                    <FaMapMarkerAlt className="text-red-500 text-xl mr-4 mt-1" />
                                    <div>
                                        <h3 className="font-semibold">
                                            Alamat Lengkap
                                        </h3>
                                        <p className="text-gray-600">
                                            Jl. Tanjungan Desa Jonggi Manulus
                                            Kec.Parmaksian Kab.Toba
                                            Prov.Sumatera Utara
                                        </p>
                                    </div>
                                </div>

                                <div className="flex items-start">
                                    
                                </div>

                                <div className="flex items-start">
                                    <FaEnvelope className="text-green-500 text-xl mr-4 mt-1" />
                                    <div>
                                        <h3 className="font-semibold">Email</h3>
                                        <p className="text-gray-600">
                                            smaparmaksian@gmail.com 
                                        </p>
                                    </div>
                                </div>

                                <div className="pt-4">
                                    <h3 className="font-semibold mb-2">
                                        Jam Operasional
                                    </h3>
                                    <ul className="space-y-2 text-gray-600">
                                        <li className="flex justify-between">
                                            <span>Senin-Sabtu (Kecuali Jumat):</span>
                                            <span>07.00 - 14.00 WIB</span>
                                        </li>
                                        <li className="flex justify-between">
                                            <span>Jumat:</span>
                                            <span>07.00 - 12.00 WIB</span>
                                        </li>
                                        <li className="flex justify-between">
                                            <span>Minggu:</span>
                                            <span>Tutup</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <button className="mt-8 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                                Hubungi Kami
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default LocationPage;

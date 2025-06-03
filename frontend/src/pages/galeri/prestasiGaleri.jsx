import React, { useState, useEffect } from 'react';
import axios from "axios";

const PrestasiDanGaleri = () => {
  const [prestasiAkademik, setPrestasiAkademik] = useState([]);
  const [prestasiNonAkademik, setPrestasiNonAkademik] = useState([]); // State untuk Prestasi Non Akademik
  const [loading, setLoading] = useState(true);

  // Mengambil data prestasi akademik dan galeri dari API
  useEffect(() => {
    // Mengambil data prestasi akademik
    axios.get('http://localhost:8000/api/prestasi') // URL API untuk Prestasi Akademik
      .then(response => {
        setPrestasiAkademik(response.data.prestasi); // Menyimpan data prestasi akademik ke state
        setLoading(false);
      })
      .catch(error => {
        console.error('There was an error fetching the data!', error);
        setLoading(false);
      });

    // Mengambil data Prestasi Non Akademik
    axios.get('http://localhost:8000/api/prestasiNon') // URL API untuk Prestasi Non Akademik
      .then(response => {
        setPrestasiNonAkademik(response.data.prestasiNon); // Menyimpan data prestasi non akademik ke state
      })
      .catch(error => {
        console.error('There was an error fetching the Prestasi Non Akademik data!', error);
      });
  }, []);

  // Bagian render
  return (
    <div className="bg-gray-200 min-h-screen py-8">
      <div className="container mx-auto px-4">
        {/* Tabel Prestasi Akademik */}
        <div className="bg-white rounded-lg shadow-md p-6 mb-12">
          <h2 className="text-2xl font-bold text-gray-800 mb-4 text-left">Prestasi Akademik</h2>
          <div className="overflow-x-auto">
            {loading ? (
              <p>Loading...</p>
            ) : (
              <table className="min-w-full border border-gray-300" style={{ tableLayout: 'fixed' }}>
                <thead>
                  <tr className="bg-gray-100">
                    <th className="border border-gray-300 px-4 py-2">No</th>
                    <th className="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                    <th className="border border-gray-300 px-4 py-2">Tanggal Pelaksanaan</th>
                    <th className="border border-gray-300 px-4 py-2">Kejuruan</th>
                    <th className="border border-gray-300 px-4 py-2">Tingkat</th>
                    <th className="border border-gray-300 px-4 py-2">Penyelenggara</th>
                  </tr>
                </thead>
                <tbody>
                  {prestasiAkademik.map((prestasi, index) => (
                    <tr key={prestasi.id} className="hover:bg-gray-50 transition duration-300">
                      <td className="border border-gray-300 px-4 py-2">{index + 1}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.nama_lengkap}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.tanggal_pelaksanaan}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.kejuruan}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.tingkat}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.penyelenggara}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            )}
          </div>
        </div>

        {/* Tabel Prestasi Non Akademik */}
        <div className="bg-white rounded-lg shadow-md p-6 mb-12">
          <h2 className="text-2xl font-bold text-gray-800 mb-4 text-left">Prestasi Non Akademik</h2>
          <div className="overflow-x-auto">
            {loading ? (
              <p>Loading...</p>
            ) : (
              <table className="min-w-full border border-gray-300" style={{ tableLayout: 'fixed' }}>
                <thead>
                  <tr className="bg-gray-100">
                    <th className="border border-gray-300 px-4 py-2">No</th>
                    <th className="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                    <th className="border border-gray-300 px-4 py-2">Tanggal Pelaksanaan</th>
                    <th className="border border-gray-300 px-4 py-2">Kejuruan</th>
                    <th className="border border-gray-300 px-4 py-2">Tingkat</th>
                    <th className="border border-gray-300 px-4 py-2">Penyelenggara</th>
                  </tr>
                </thead>
                <tbody>
                  {prestasiNonAkademik.map((prestasi, index) => (
                    <tr key={prestasi.id} className="hover:bg-gray-50 transition duration-300">
                      <td className="border border-gray-300 px-4 py-2">{index + 1}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.nama_lengkap}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.tanggal_pelaksanaan}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.kejuruan}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.tingkat}</td>
                      <td className="border border-gray-300 px-4 py-2">{prestasi.penyelenggara}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default PrestasiDanGaleri;

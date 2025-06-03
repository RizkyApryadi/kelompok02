import {
    FaFacebookF,
    FaTwitter,
    FaInstagram,
    FaLinkedinIn,
    FaYoutube,
} from "react-icons/fa";

const Footer = () => {
    const currentYear = new Date().getFullYear();

    return (
        <footer className="bg-gray-900 text-white w-full mt-16">
            <div className="container mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                {/* About Column */}
                <div className="space-y-4">
                    <h3 className="text-lg font-semibold">Tentang Kami</h3>
                    <p className="text-sm text-gray-400 leading-relaxed">
                        SMA Negeri 1 Parmaksian adalah sekolah menengah atas negeri
                        yang terletak di Desa Jonggi Manulus, Kecamatan Parmaksian, Provinsi Sumatera
                        Utara, Indonesia.
                    </p>
                </div>

                {/* Quick Links */}
                <div className="space-y-4">
                    <h3 className="text-lg font-semibold">Tautan Cepat</h3>
                    <ul className="space-y-2">
                        {[
                            { path: "/", label: "Beranda" },
                            { path: "/about", label: "Tentang Sekolah" },
                            { path: "/facilities", label: "Fasilitas" },
                            { path: "/gallery", label: "Galeri" },
                        ].map((item) => (
                            <li key={item.path}>
                                <a
                                    href={item.path}
                                    className="text-gray-400 hover:text-white transition text-sm"
                                >
                                    {item.label}
                                </a>
                            </li>
                        ))}
                    </ul>
                </div>

                {/* Contact */}
                <div className="space-y-4">
                    <h3 className="text-lg font-semibold">Kontak</h3>
                    <address className="text-gray-400 text-sm not-italic">
                        <p>Jl. Tanjungan</p>
                        <p>Desa Jonggi Manulus Kec.Parmaksian Kab.Toba Prov.Sumatera Utara</p>
                        <p>Indonesia</p>
                        <p className="mt-2">
                            Email: smaparmaksian@gmail.com
                        </p>
                    </address>
                </div>

                {/* Social Media */}
                <div className="space-y-4">
                    <h3 className="text-lg font-semibold">Media Sosial</h3>
                    <div className="flex space-x-4">
                        {[
                            {
                                icon: <FaFacebookF />,
                                color: "text-blue-500",
                                link: "https://web.facebook.com/sman.parmaksian.3",
                            },
                            {
                                icon: <FaInstagram />,
                                color: "text-pink-500",
                                link: "https://www.instagram.com/sman.1parmaksian?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==",
                            },
                        ].map((social, index) => (
                            <a
                                key={index}
                                href={social.link}
                                target="_blank"
                                rel="noopener noreferrer"
                                className={`${social.color} hover:opacity-80 transition text-xl`}
                                aria-label={`Social media ${index}`}
                            >
                                {social.icon}
                            </a>
                        ))}
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;

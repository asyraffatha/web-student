import React, { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const Home = () => {
    const [progress, setProgress] = useState({});
    const navigate = useNavigate();
    const userId = "1";

    useEffect(() => {
        axios
            .get(`http://127.0.0.1:8000/api/progress/${userId}`)
            .then((response) => setProgress(response.data))
            .catch((error) => console.error("Error fetching progress:", error));
    }, []);

    return (
        <div className="flex flex-col items-center mt-10">
            <button
                className="bg-blue-500 text-white px-6 py-3 rounded-lg mb-4"
                onClick={() => navigate("/soal/bilangan-berpangkat")}
            >
                Bilangan Berpangkat
            </button>

            <button
                className={`px-6 py-3 rounded-lg mb-4 ${
                    progress.bilangan_berpangkat
                        ? "bg-blue-500"
                        : "bg-gray-400 cursor-not-allowed"
                }`}
                disabled={!progress.bilangan_berpangkat}
                onClick={() => navigate("/soal/perpangkatan")}
            >
                Perpangkatan {progress.bilangan_berpangkat ? "" : "🔒"}
            </button>

            <button
                className={`px-6 py-3 rounded-lg ${
                    progress.perpangkatan
                        ? "bg-blue-500"
                        : "bg-gray-400 cursor-not-allowed"
                }`}
                disabled={!progress.perpangkatan}
                onClick={() => navigate("/soal/pembagian-perpangkatan")}
            >
                Pembagian Perpangkatan {progress.perpangkatan ? "" : "🔒"}
            </button>
        </div>
    );
};

export default Home;

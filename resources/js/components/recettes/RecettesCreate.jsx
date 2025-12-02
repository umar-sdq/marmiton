import React, { useState } from "react";
import axios from "../../axios"; 
import { Link, useHistory } from "react-router-dom";

export default function RecettesCreate() {
    console.log("BASE URL =", axios.defaults.baseURL);
    const history = useHistory();

    const [titre, setTitre] = useState("");
    const [description, setDescription] = useState("");
    const [photo, setPhoto] = useState(null);
    const [error, setError] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");

        try {
            const token = localStorage.getItem("token");

            let formData = new FormData();
            formData.append("titre", titre);
            formData.append("description", description);
            if (photo) formData.append("photo", photo);
            console.log("AXIOS BASE =", axios.defaults.baseURL);
            console.log("URL POST =", axios.defaults.baseURL + "recettes");

            await axios.post("recettes", formData, {
    headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
        Accept: "application/json"
    }
});



            history.push("/recettes");

        } catch (err) {
            console.error(err);
            setError("Erreur lors de l'ajout de la recette");
        }
    };

    return (
        <div className="container mt-4">
            <h1>Ajouter une recette</h1>

            {error && <div className="alert alert-danger">{error}</div>}

            <form onSubmit={handleSubmit} encType="multipart/form-data">
                
                <div className="form-group mb-3">
                    <label>Titre :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setTitre(e.target.value)}
                        required
                    />
                </div>

                <div className="form-group mb-3">
                    <label>Description :</label>
                    <textarea
                        className="form-control"
                        rows="5"
                        onChange={(e) => setDescription(e.target.value)}
                        required
                    ></textarea>
                </div>

                <div className="form-group mb-3">
                    <label>Image :</label>
                    <input
                        type="file"
                        className="form-control"
                        onChange={(e) => setPhoto(e.target.files[0])}
                    />
                </div>

                <button type="submit" className="btn btn-primary">Pubier</button>
                <Link to="/recettes" className="btn btn-info ms-2">Retour</Link>
            </form>
        </div>
    );
}

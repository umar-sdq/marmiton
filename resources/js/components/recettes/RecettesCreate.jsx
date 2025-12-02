import React, { useEffect, useState } from "react";
import axios from "axios"; 
import { Link, useHistory } from "react-router-dom";

export default function RecettesCreate() {
    const history = useHistory();

    const [titre, setTitre] = useState("");
    const [description, setDescription] = useState("");
    const [photo, setPhoto] = useState(null);
    const [utilisateurs, setUtilisateurs] = useState([]);
    const [utilisateurId, setUtilisateurId] = useState("");
    const [error, setError] = useState("");

    useEffect(() => {
        axios
            .get("http://127.0.0.1:8000/api/utilisateurs")
            .then(res => setUtilisateurs(res.data.data ?? res.data))
            .catch(err => console.error(err));
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");

        try {
            let formData = new FormData();
            formData.append("titre", titre);
            formData.append("description", description);
            formData.append("utilisateur_id", utilisateurId);
            if (photo) formData.append("photo", photo);

            const token = localStorage.getItem("token");

            await axios.post(
                "http://127.0.0.1:8000/api/recettes",
                formData,
                {
                    headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "multipart/form-data"
                    }
                }
            );

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
                    />
                </div>

                <div className="form-group mb-3">
                    <label>Description :</label>
                    <textarea
                        className="form-control"
                        rows="5"
                        onChange={(e) => setDescription(e.target.value)}
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

                <div className="form-group mb-3">
                    <label>Auteur :</label>
                    <select
                        className="form-control"
                        onChange={(e) => setUtilisateurId(e.target.value)}
                    >
                        <option>Choisir...</option>
                        {utilisateurs.map((u) => (
                            <option key={u.id} value={u.id}>
                                {u.nom}
                            </option>
                        ))}
                    </select>
                </div>

                <button type="submit" className="btn btn-primary">Publier</button>
                <Link to="/recettes" className="btn btn-info ms-2">Retour</Link>
            </form>
        </div>
    );
}

import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link, useParams, useHistory } from "react-router-dom";

export default function RecettesEdit() {
    const { id } = useParams();
    const history = useHistory();

    const [titre, setTitre] = useState("");
    const [description, setDescription] = useState("");
    const [utilisateurId, setUtilisateurId] = useState("");
    const [utilisateurs, setUtilisateurs] = useState([]);

    useEffect(() => {
        axios.get(`/recettes/${id}`).then(res => {
            setTitre(res.data.titre);
            setDescription(res.data.description);
            setUtilisateurId(res.data.utilisateur_id);
        });

        axios.get("/utilisateurs").then(res => setUtilisateurs(res.data));
    }, [id]);

    const handleSubmit = (e) => {
        e.preventDefault();

        axios.put(`/recettes/${id}`, {
            titre,
            description,
            utilisateur_id: utilisateurId
        }).then(() => {
            history.push(`/recettes/${id}`);
        });
    };

    return (
        <div className="container mt-4">

            <h1>Modifier : {titre}</h1>

            <form onSubmit={handleSubmit}>

                <div className="mb-3">
                    <label>Titre :</label>
                    <input
                        type="text"
                        className="form-control"
                        value={titre}
                        onChange={(e) => setTitre(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Description :</label>
                    <textarea
                        className="form-control"
                        rows="5"
                        value={description}
                        onChange={(e) => setDescription(e.target.value)}
                    ></textarea>
                </div>

                <div className="mb-3">
                    <label>Auteur :</label>
                    <select
                        className="form-control"
                        value={utilisateurId}
                        onChange={(e) => setUtilisateurId(e.target.value)}
                    >
                        {utilisateurs.map(u => (
                            <option key={u.id} value={u.id}>{u.nom}</option>
                        ))}
                    </select>
                </div>

                <button className="btn btn-primary">Enregistrer</button>
                <Link to={`/recettes/${id}`} className="btn btn-secondary ms-2">Annuler</Link>

            </form>

        </div>
    );
}

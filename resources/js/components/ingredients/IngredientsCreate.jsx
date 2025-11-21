import React, { useState, useEffect } from "react";
import axios from "axios";
import { Link, useHistory } from "react-router-dom";

export default function IngredientsCreate() {
    const [nom, setNom] = useState("");
    const [details, setDetails] = useState("");
    const [recetteId, setRecetteId] = useState("");
    const [recettes, setRecettes] = useState([]);
    const history = useHistory();

    useEffect(() => {
        axios.get("/recettes")
            .then(res => setRecettes(res.data))
            .catch(err => console.error(err));
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();

        axios.post("/ingredients", {
            nom: nom,
            liste_ingredients: details,
            recette_id: recetteId
        }).then(() => {
            history.push("/ingredients");
        }).catch(err => console.error(err));
    };

    return (
        <div className="container mt-4">
            <h2>Ajouter un ingrédient</h2>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label>Nom :</label>
                    <input
                        type="text"
                        className="form-control"
                        value={nom}
                        onChange={(e) => setNom(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Détails :</label>
                    <textarea
                        className="form-control"
                        rows="3"
                        value={details}
                        onChange={(e) => setDetails(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Recette :</label>
                    <select
                        className="form-control"
                        value={recetteId}
                        onChange={(e) => setRecetteId(e.target.value)}
                    >
                        <option value="">Choisir…</option>
                        {recettes.map((r) => (
                            <option key={r.id} value={r.id}>{r.titre}</option>
                        ))}
                    </select>
                </div>

                <button className="btn btn-primary">Enregistrer</button>
                <Link to="/ingredients" className="btn btn-secondary ms-2">Retour</Link>
            </form>
        </div>
    );
}

import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link, useParams, useHistory } from "react-router-dom";

export default function IngredientsEdit() {
    const { id } = useParams();
    const history = useHistory();

    const [nom, setNom] = useState("");
    const [details, setDetails] = useState("");
    const [recetteId, setRecetteId] = useState("");
    const [recettes, setRecettes] = useState([]);

    useEffect(() => {
        axios.get(`/ingredients/${id}`).then(res => {
            setNom(res.data.nom);
            setDetails(res.data.liste_ingredients);
            setRecetteId(res.data.recette_id);
        });

        axios.get("/recettes").then(res => setRecettes(res.data));
    }, [id]);

    const handleSubmit = (e) => {
        e.preventDefault();

        axios.put(`/ingredients/${id}`, {
            nom,
            liste_ingredients: details,
            recette_id: recetteId,
        }).then(() => {
            history.push(`/ingredients/${id}`);
        });
    };

    return (
        <div className="container mt-4">
            <h2>Modifier : {nom}</h2>

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
                        {recettes.map((r) => (
                            <option key={r.id} value={r.id}>{r.titre}</option>
                        ))}
                    </select>
                </div>

                <button className="btn btn-primary">Mettre à jour</button>
                <Link to={`/ingredients/${id}`} className="btn btn-secondary ms-2">
                    Annuler
                </Link>
            </form>
        </div>
    );
}

import React, { useEffect, useState } from "react";
import axios from "../../axios";
import { Link, useHistory } from "react-router-dom";

export default function IngredientsCreate() {
    const history = useHistory();

    const [nom, setNom] = useState("");
    const [details, setDetails] = useState("");
    const [recettes, setRecettes] = useState([]);
    const [recetteId, setRecetteId] = useState("");
    const [error, setError] = useState("");

    useEffect(() => {
        axios.get("/recettes")
            .then(res => setRecettes(res.data))
            .catch(err => console.error(err));
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");

        try {
            const token = localStorage.getItem("token");

            await axios.post("/ingredients", {
                nom: nom,
                liste_ingredients: details,
                recette_id: recetteId
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            history.push("/ingredients");

        } catch (err) {
            setError("Erreur lors de l'ajout de l'ingrédient");
        }
    };

    return (
        <div className="container mt-4">
            <h1>Ajouter un ingrédient</h1>

            {error && <div className="alert alert-danger">{error}</div>}

            <form onSubmit={handleSubmit}>

                <div className="form-group mb-3">
                    <label>Nom :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setNom(e.target.value)}
                    />
                </div>

                <div className="form-group mb-3">
                    <label>Détails :</label>
                    <textarea
                        className="form-control"
                        rows="3"
                        onChange={(e) => setDetails(e.target.value)}
                    ></textarea>
                </div>

                <div className="form-group mb-3">
                    <label>Recette :</label>
                    <select
                        className="form-control"
                        onChange={(e) => setRecetteId(e.target.value)}
                    >
                        <option>Choisir...</option>
                        {recettes.map((r) => (
                            <option key={r.id} value={r.id}>
                                {r.titre}
                            </option>
                        ))}
                    </select>
                </div>

                <button className="btn btn-primary">Enregistrer</button>
                <Link to="/ingredients" className="btn btn-info ms-2">Retour</Link>

            </form>
        </div>
    );
}

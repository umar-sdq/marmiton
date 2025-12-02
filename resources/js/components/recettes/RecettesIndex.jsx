import React, { useEffect, useState } from "react";
import axios from "../../axios";
import { Link } from "react-router-dom";

export default function RecettesIndex() {
    const [recettes, setRecettes] = useState([]);

    useEffect(() => {
        axios.get("/recettes")
    .then(res => {
        console.log("RAW:", res.data);

        const recettesArray = res.data.data ?? res.data;

        if (Array.isArray(recettesArray)) {
            setRecettes(recettesArray);
        } else {
            console.warn("Not an array:", recettesArray);
            setRecettes([]);
        }
    })

            .catch(err => {
                console.error("API ERROR:", err);
                if (err.response) {
                    console.log("STATUS:", err.response.status);
                    console.log("DATA:", err.response.data);
                }
            });
    }, []);

    if (!Array.isArray(recettes)) {
        console.log("❌ recettes n'est pas un array:", recettes);
        return <p>Chargement…</p>;
    }

    return (
        <div className="container mt-4">
            <div className="d-flex justify-content-between align-items-center">
                <h2>Liste des recettes</h2>
                <Link className="btn btn-success" to="/recettes/create">
                    Ajouter une recette
                </Link>
            </div>

            <div className="row mt-4">
                {recettes.map((recette) => (
                    <div className="col-md-4" key={recette.id}>
                        <div className="card card-body mb-4 shadow-sm">
                            {recette.photo ? (
                                <img
                                    src={`/images/${recette.photo}`}
                                    alt={recette.titre}
                                    className="img-fluid rounded mb-3"
                                    style={{ maxHeight: "200px", objectFit: "cover" }}
                                />
                            ) : (
                                <p className="text-muted fst-italic">Aucune image</p>
                            )}

                            <h4 className="fw-bold">{recette.titre}</h4>
                            <p>{recette.description?.substring(0, 100)}...</p>

                            <Link
                                className="btn btn-outline-primary"
                                to={`/recettes/${recette.id}`}
                            >
                                Lire plus
                            </Link>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}

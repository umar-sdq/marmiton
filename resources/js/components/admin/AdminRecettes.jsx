import React, { useEffect, useState, useContext } from "react";
import axios from "axios";
import { AuthContext } from "../context/AuthContext";
import { Link } from "react-router-dom";

export default function AdminRecettes() {
    const [recettes, setRecettes] = useState([]);
    const { role } = useContext(AuthContext);

    useEffect(() => {
        axios.get("http://127.0.0.1:8000/api/recettes", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`
            }
        })
        .then(res => setRecettes(res.data))
        .catch(err => console.error(err));
    }, []);

    const handleDelete = (id) => {
        if (!window.confirm("Supprimer cette recette ?")) return;

        axios.delete(`http://127.0.0.1:8000/api/recettes/${id}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`
            }
        })
        .then(() => {
            setRecettes(recettes.filter(r => r.id !== id));
        })
        .catch(err => console.error(err));
    };

    return (
        <div className="container mt-4">

            <h1 className="mb-4 text-center">Espace Administrateur</h1>

            <div className="alert alert-success text-center">
                Bonjour 👋 — vous êtes connecté en tant que <strong>{role}</strong>.
            </div>

            <h3 className="mt-4">Liste des recettes</h3>

            {recettes.length === 0 ? (
                <p>Aucune recette trouvée pour le moment.</p>
            ) : (
                <table className="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {recettes.map((recette) => (
                            <tr key={recette.id}>
                                <td>{recette.id}</td>
                                <td>{recette.titre}</td>
                                <td>{recette.description?.substring(0, 60)}...</td>
                                <td>{recette.created_at}</td>
                                <td>
                                    <Link to={`/recettes/${recette.id}/edit`} className="btn btn-warning btn-sm me-2">
                                        Modifier
                                    </Link>

                                    <button 
                                        className="btn btn-danger btn-sm"
                                        onClick={() => handleDelete(recette.id)}
                                    >
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
}

import React, { useState } from "react";
import axios from "axios";
import { Link, useHistory } from "react-router-dom";

export default function Register() {
    const history = useHistory();

    const [nom, setNom] = useState("");
    const [identifiant, setIdentifiant] = useState("");
    const [email, setEmail] = useState("");
    const [motDePasse, setMotDePasse] = useState("");
    const [confirmationMotDePasse, setConfirmationMotDePasse] = useState("");
    const API = "http://127.0.0.1:8000";

    const [error, setError] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");

        try {
            await axios.get("/sanctum/csrf-cookie");

           const res = await axios.post(`${API}/api/register`, {
                nom: nom,
                identifiant: identifiant,
                email: email,
                mot_de_passe: motDePasse,
                confirmation_mot_de_passe: confirmationMotDePasse,
            });

            if (res.data.success) {
                history.push("/login");
            } else {
                setError("Erreur lors de l'inscription");
            }

        } catch (err) {
            setError("Erreur lors de l'inscription");
        }
    };

    return (
        <div className="container mt-4">

            <h1>Inscription</h1>

            {error && <div className="alert alert-danger">{error}</div>}

            <form onSubmit={handleSubmit}>

                <div className="mb-3">
                    <label>Nom :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setNom(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Identifiant :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setIdentifiant(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Email :</label>
                    <input
                        type="email"
                        className="form-control"
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Mot de passe :</label>
                    <input
                        type="password"
                        className="form-control"
                        onChange={(e) => setMotDePasse(e.target.value)}
                    />
                </div>

                <div className="mb-3">
                    <label>Confirmer le mot de passe :</label>
                    <input
                        type="password"
                        className="form-control"
                        onChange={(e) => setConfirmationMotDePasse(e.target.value)}
                    />
                </div>

                <button className="btn btn-primary">S'inscrire</button>
                <Link to="/login" className="btn btn-secondary ms-2">
                    Déjà un compte ?
                </Link>
            </form>

        </div>
    );
}

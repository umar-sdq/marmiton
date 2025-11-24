import React, { useState } from "react";
import axios from "axios";
import { Link, useHistory } from "react-router-dom";

export default function Login() {
    const history = useHistory();

    const [identifiant, setIdentifiant] = useState("");
    const [password, setPassword] = useState("");
    const [remember, setRemember] = useState(false);
    const [error, setError] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");

        try {
            await axios.get("/sanctum/csrf-cookie");

            const res = await axios.post("/api/login", {
                identifiant: identifiant,
                password: password,
                remember: remember,
            });

            if (res.data.success === true) {
                if (res.data.token) {
                    localStorage.setItem("token", res.data.token);
                }
                history.push("/"); 
            } else {
                setError(res.data.message || "Identifiants invalides");
            }

        } catch (err) {
            setError("Identifiants invalides");
        }
    };

    return (
        <div className="container mt-4">
            <h1>Connexion</h1>

            {error && <div className="alert alert-danger">{error}</div>}

            <form onSubmit={handleSubmit}>

                <div className="mb-3">
                    <label>Identifiant :</label>
                    <input
                        type="text"
                        className="form-control"
                        onChange={(e) => setIdentifiant(e.target.value)}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label>Mot de passe :</label>
                    <input
                        type="password"
                        className="form-control"
                        onChange={(e) => setPassword(e.target.value)}
                        required
                    />
                </div>

                <div className="mb-3 form-check">
                    <input
                        type="checkbox"
                        className="form-check-input"
                        id="remember"
                        checked={remember}
                        onChange={(e) => setRemember(e.target.checked)}
                    />
                    <label className="form-check-label" htmlFor="remember">
                        Se souvenir de moi
                    </label>
                </div>

                <button type="submit" className="btn btn-primary">
                    Se connecter
                </button>

                <Link
                    to="/password/reset"
                    className="btn btn-link ms-2"
                >
                    Mot de passe oublié ?
                </Link>
            </form>
        </div>
    );
}

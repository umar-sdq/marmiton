import React, { useState } from "react";
import axios from "axios";
import { Link, useHistory } from "react-router-dom";
import { AuthContext } from "../context/AuthContext";
import { useContext } from "react";

export default function Login() {
    const history = useHistory();

    const [identifiant, setIdentifiant] = useState("");
    const [password, setPassword] = useState("");
    const [remember, setRemember] = useState(false);
    const [error, setError] = useState("");
    const { login } = useContext(AuthContext);


    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");

        try {
            const res = await axios.post(
                "http://127.0.0.1:8000/api/login",
                {
                    identifiant: identifiant,
                    mot_de_passe: password,
                    remember: remember,
                },
                {
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    }
                }
            );

            if (res.data.success && res.data.data?.token) {
                // Sauvegarde du token
                login(res.data.data.token);

                // Redirection
                history.push("/");
            } else {
                setError(res.data.message || "Identifiants invalides");
            }

        } catch (err) {
            console.error("Login error:", err);
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
                        value={identifiant}
                        onChange={(e) => {
                            setIdentifiant(e.target.value);
                            setError("");
                        }}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label>Mot de passe :</label>
                    <input
                        type="password"
                        className="form-control"
                        value={password}
                        onChange={(e) => {
                            setPassword(e.target.value);
                            setError("");
                        }}
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

                <Link to="/password/reset" className="btn btn-link ms-2">
                    Mot de passe oublié ?
                </Link>
            </form>
        </div>
    );
}

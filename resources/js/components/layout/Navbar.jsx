import React from "react";
import { Link, useHistory } from "react-router-dom";
import axios from "axios";

export default function Navbar() {
    const history = useHistory();
    const auth = window.user_auth_data;

    const handleLogout = () => {
        axios.post("/logout").then(() => {
            window.location.href = "/login";
        });
    };

    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark px-3">
            <Link className="navbar-brand" to="/">
                Marmiton
            </Link>

            <div className="collapse navbar-collapse">
                <ul className="navbar-nav ms-auto">

                    {/* PUBLIC LINKS */}
                    {!auth.isLoggedin && (
                        <>
                            <li className="nav-item">
                                <a className="nav-link" href="/login">Connexion</a>
                            </li>

                            <li className="nav-item">
                                <a className="nav-link" href="/register">Inscription</a>
                            </li>
                        </>
                    )}

                    {/* LOGGED-IN LINKS */}
                    {auth.isLoggedin && (
                        <>
                            <li className="nav-item">
                                <Link className="nav-link" to="/home">Dashboard</Link>
                            </li>

                            <li className="nav-item">
                                <Link className="nav-link" to="/recettes">Recettes</Link>
                            </li>

                            <li className="nav-item">
                                <Link className="nav-link" to="/ingredients">Ingrédients</Link>
                            </li>

                            {/* ADMIN */}
                            {auth.user?.role === "ADMIN" && (
                                <li className="nav-item">
                                    <Link className="nav-link" to="/admin/recettes">Admin</Link>
                                </li>
                            )}

                            <li className="nav-item">
                                <button
                                    onClick={handleLogout}
                                    className="btn btn-danger ms-3"
                                >
                                    Déconnexion
                                </button>
                            </li>
                        </>
                    )}
                </ul>
            </div>
        </nav>
    );
}

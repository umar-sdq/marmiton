import React from "react";
import { Link, useHistory } from "react-router-dom";
import axios from "../../axios";

export default function Navbar() {
    const history = useHistory();
    console.log("TOKEN IN NAVBAR:", localStorage.getItem("token"));

    const auth = {
    isLoggedin: !!localStorage.getItem("token"),
    user: {} 
};


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

                    {!auth.isLoggedin && (
    <>
        <li className="nav-item">
            <Link className="nav-link" to="/login">Connexion</Link>
        </li>

        <li className="nav-item">
            <Link className="nav-link" to="/register">Inscription</Link>
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

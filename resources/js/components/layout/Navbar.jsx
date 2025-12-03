import React, { useContext } from "react";
import { Link, useHistory } from "react-router-dom";
import axios from "../../axios";
import { AuthContext } from "../context/AuthContext";

export default function Navbar() {
    const history = useHistory();
    const { isLoggedIn, role, logout } = useContext(AuthContext);


    const handleLogout = () => {
        axios.post("/logout", {}, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`
            }
        })
        .finally(() => {
            logout();
            history.push("/login");
        });
    };

    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark px-3">
            <Link className="navbar-brand" to="/">Marmiton</Link>

            <div className="collapse navbar-collapse">
                <ul className="navbar-nav ms-auto">

                    {!isLoggedIn && (
                        <>
                            <li className="nav-item">
                                <Link className="nav-link" to="/login">Connexion</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/register">Inscription</Link>
                            </li>
                        </>
                    )}

                    {isLoggedIn && (
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

                           {isLoggedIn && role === "ADMIN" && (
    <li className="nav-item">
        <Link className="nav-link" to="/admin/recettes">Admin Panel</Link>
    </li>
)}


                            <li className="nav-item">
                                <button className="btn btn-danger ms-3" onClick={handleLogout}>
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

import React, { useState } from "react";
import axios from "../../axios";
import { Link } from "react-router-dom";

export default function SearchPage() {

    const [query, setQuery] = useState("");
    const [results, setResults] = useState([]);

    const fetchResults = async (value) => {
        setQuery(value);

        if (value.length < 2) {
            setResults([]);
            return;
        }

        try {
            const res = await axios.get("/recettes/autocomplete", {
                params: { search: value }
            });

            setResults(res.data);
        } catch (err) {
            console.error(err);
        }
    };

    return (
        <div className="container mt-4">
            <h1>Recherche de recettes</h1>

            <input
                type="text"
                className="form-control"
                placeholder="Chercher une recette..."
                value={query}
                onChange={(e) => fetchResults(e.target.value)}
            />

            <ul className="list-group mt-3">
                {results.map((r) => (
                    <li key={r.id} className="list-group-item d-flex justify-content-between align-items-center">
                        {r.titre}

                        <Link className="btn btn-primary btn-sm" to={`/recettes/${r.id}`}>
                            Voir recette
                        </Link>
                    </li>
                ))}
            </ul>
        </div>
    );
}

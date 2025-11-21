import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";

export default function IngredientsIndex() {
    const [ingredients, setIngredients] = useState([]);

    useEffect(() => {
        axios.get("/ingredients")
            .then(res => setIngredients(res.data))
            .catch(err => console.error(err));
    }, []);

    return (
        <div className="container mt-4">

            <div className="d-flex justify-content-between align-items-center mb-3">
                <h2>Liste des ingrédients</h2>
                <Link to="/ingredients/create" className="btn btn-success">Ajouter</Link>
            </div>

            <div className="row">
                {ingredients.map((ingredient) => (
                    <div className="col-md-4" key={ingredient.id}>
                        <div className="card card-body mb-3">
                            <h4>{ingredient.nom}</h4>
                            <p>{ingredient.liste_ingredients}</p>
                            <p>
                                <strong>Recette : </strong>
                                {ingredient.recette?.titre || "—"}
                            </p>
                            <Link
                                to={`/ingredients/${ingredient.id}`}
                                className="btn btn-primary"
                            >
                                Voir
                            </Link>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}

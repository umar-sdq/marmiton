import React from "react";

export default function Welcome() {
    return (
        <div style={{ background: "linear-gradient(135deg, #fffaf5, #f6ede6)" }}>

            <header
                style={{
                    background: "linear-gradient(90deg, #d9a679, #c97e5b)",
                    padding: "1rem 2rem",
                    color: "white",
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                }}
            >
                <h1 style={{ fontWeight: "700" }}>Marmiton</h1>
                <nav>
                    <a href="/login" style={{ color: "white", marginLeft: "1.5rem" }}>Connexion</a>
                    <a href="/register" style={{ color: "white", marginLeft: "1.5rem" }}>Inscription</a>
                </nav>
            </header>

            <section className="hero" style={{ textAlign: "center", padding: "5rem 1rem" }}>
                <h2 style={{ fontSize: "2.6rem", color: "#875c3d" }}>Marmiton</h2>
                <p style={{ maxWidth: "700px", margin: "auto", color: "#4a3a31" }}>
                    Marmiton n’est pas un réseau culinaire.  
                    C’est votre espace privé pour consigner vos plats, tester et suivre vos créations.
                </p>

                <a
                    href="/login"
                    className="btn"
                    style={{
                        marginTop: "2rem",
                        background: "linear-gradient(90deg, #c97e5b, #d9a679)",
                        color: "white",
                        padding: "0.8rem 1.8rem",
                        borderRadius: "10px",
                        textDecoration: "none",
                        fontWeight: "600",
                    }}
                >
                    Commencer à enregistrer
                </a>
            </section>

            <section
                className="features"
                style={{
                    display: "grid",
                    gridTemplateColumns: "repeat(auto-fit, minmax(250px, 1fr))",
                    gap: "2rem",
                    maxWidth: "1000px",
                    margin: "4rem auto",
                }}
            >
                <FeatureCard
                    title="Enregistrer vos recettes"
                    text="Ajoutez titres, ingrédients, instructions et photos pour chaque plat."
                />
                <FeatureCard
                    title="Suivi personnel"
                    text="Gardez une trace de votre progression et vos plats préférés."
                />
                <FeatureCard
                    title="Un espace privé"
                    text="Vos recettes vous appartiennent. Tout est privé et sécurisé."
                />
            </section>

            <footer
                style={{
                    textAlign: "center",
                    padding: "2rem",
                    color: "#6b4b32",
                    background: "#fffaf5",
                }}
            >
                &copy; {new Date().getFullYear()} Marmiton — Votre carnet culinaire
            </footer>
        </div>
    );
}

function FeatureCard({ title, text }) {
    return (
        <div
            style={{
                background: "white",
                padding: "2rem",
                borderRadius: "16px",
                boxShadow: "0 6px 16px rgba(0,0,0,0.05)",
                textAlign: "center",
            }}
        >
            <h3 style={{ color: "#b06b41" }}>{title}</h3>
            <p style={{ color: "#4a3a31" }}>{text}</p>
        </div>
    );
}

import React from "react";

export default function Dashboard() {
    return (
        <div className="container mt-4">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card shadow-sm">
                        <div className="card-header fw-bold">Dashboard</div>

                        <div className="card-body">
                            Vous êtes connecté !
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

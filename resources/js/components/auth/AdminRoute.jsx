import React from "react";
import { Route, Redirect } from "react-router-dom";

export default function AdminRoute({ component: Component, ...rest }) {
    const auth = window.user_auth_data;

    return (
        <Route
            {...rest}
            render={(props) =>
                auth.isLoggedin && auth.user.role === "ADMIN" ? (
                    <Component {...props} />
                ) : (
                    <Redirect to="/" />
                )
            }
        />
    );
}

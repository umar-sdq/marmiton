import React, { useContext } from "react";
import { Route, Redirect } from "react-router-dom";
import { AuthContext } from "../context/AuthContext";

export default function AdminRoute({ component: Component, ...rest }) {
    const { isLoggedIn, user } = useContext(AuthContext);

    return (
        <Route
            {...rest}
            render={(props) =>
                isLoggedIn && user?.role === "ADMIN"
                    ? <Component {...props} />
                    : <Redirect to="/login" />
            }
        />
    );
}

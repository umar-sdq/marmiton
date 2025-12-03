import { Switch, Route } from "react-router-dom";

import Accueil from "./components/Accueil";
import Apropos from "./components/Apropos";
import Dashboard from "./components/Dashboard";
import Welcome from "./components/Welcome";

import Register from "./components/auth/Register";
import Login from "./components/auth/Login";
import AdminRoute from "./components/auth/AdminRoute";

import RecettesIndex from "./components/recettes/RecettesIndex";
import RecettesCreate from "./components/recettes/RecettesCreate";
import RecettesShow from "./components/recettes/RecettesShow";
import RecettesEdit from "./components/recettes/RecettesEdit";

import IngredientsIndex from "./components/ingredients/IngredientsIndex";
import IngredientsCreate from "./components/ingredients/IngredientsCreate";
import IngredientsShow from "./components/ingredients/IngredientsShow";
import IngredientsEdit from "./components/ingredients/IngredientsEdit";

import UtilisateursIndex from "./components/utilisateurs/UtilisateursIndex";
import UtilisateursCreate from "./components/utilisateurs/UtilisateursCreate";
import UtilisateursShow from "./components/utilisateurs/UtilisateursShow";
import UtilisateursEdit from "./components/utilisateurs/UtilisateursEdit";

import AdminRecettes from "./components/admin/AdminRecettes";

import SearchPage from "./components/SearchPage/SearchPage";

export default function Router() {
    return (
        <Switch>

            <Route exact path="/register" component={Register} />
            <Route exact path="/login" component={Login} />

            <Route exact path="/" component={Accueil} />
            <Route exact path="/accueil" component={Accueil} />
            <Route exact path="/apropos" component={Apropos} />
            <Route exact path="/home" component={Dashboard} />

            <Route exact path="/recettes" component={RecettesIndex} />
            <Route exact path="/recettes/create" component={RecettesCreate} />
            <Route exact path="/recettes/:id" component={RecettesShow} />
            <Route exact path="/recettes/:id/edit" component={RecettesEdit} />

            <Route exact path="/ingredients" component={IngredientsIndex} />
            <Route exact path="/ingredients/create" component={IngredientsCreate} />
            <Route exact path="/ingredients/:id" component={IngredientsShow} />
            <Route exact path="/ingredients/:id/edit" component={IngredientsEdit} />

            <Route exact path="/utilisateurs" component={UtilisateursIndex} />
            <Route exact path="/utilisateurs/create" component={UtilisateursCreate} />
            <Route exact path="/utilisateurs/:id" component={UtilisateursShow} />
            <Route exact path="/utilisateurs/:id/edit" component={UtilisateursEdit} />

            <Route exact path="/search" component={SearchPage} />


            <AdminRoute exact path="/admin/recettes" component={AdminRecettes} />

            <Route component={Accueil} />

        </Switch>
    );
}

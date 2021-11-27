import React, { useEffect, useReducer } from 'react';
// import PropTypes from 'prop-types';
import { BrowserRouter as Router, Switch, Route, Redirect } from "react-router-dom";

import { AuthContext } from './auth/AuthContext';
import { authReducer } from './auth/authReducer';

import PrivateRoutes from './routes/PrivateRoutes';
import PublicRoutes from './routes/PublicRoutes';

import LoginScreen from './pages/Login/LoginScreen';

import Dashboard from './pages/Dashboard/Dashboard';

const init = () => {
    return JSON.parse(localStorage.getItem('currentUser')) || { logged: false };
}


const Main = props => {

    const [user, dispatch] = useReducer(authReducer, {}, init);

    useEffect(() => {
        if (!user) return;
        localStorage.setItem('currentUser', JSON.stringify(user));
    }, [user])


    return (
        <AuthContext.Provider value={{
            user,
            dispatch
        }}>
            <Router>
                <div>
                    <Switch>
                        {/* <Route path="/login" component={LoginScreen} /> */}
                        <Route path="/login">
                            <PublicRoutes>
                                <LoginScreen />
                            </PublicRoutes>
                        </Route>
                        <Route path="/*">
                            <PrivateRoutes>
                                <Dashboard />
                            </PrivateRoutes>
                        </Route>
                        <Redirect to="/login" />
                    </Switch>
                </div>
            </Router>
        </AuthContext.Provider>
    )
}

Main.propTypes = {

}

export default Main

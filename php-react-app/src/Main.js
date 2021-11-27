import React, { useEffect, useReducer, useState } from 'react';
// import PropTypes from 'prop-types';
import Navbar from './components/Navbar';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Redirect
} from "react-router-dom";
import HomeScreen from './pages/Home/HomeScreen';
import LoginScreen from './pages/Login/LoginScreen';
import { AuthContext } from './auth/AuthContext';
import { authReducer } from './auth/authReducer';
import PrivateRoutes from './routes/PrivateRoutes';

const init = () => {
    return JSON.parse(localStorage.getItem('currentUser')) || { logged: false };
}


const Main = props => {

    const [user, dispatch] = useReducer(authReducer, {}, init);

    useEffect(() => {
        if(!user) return;
        localStorage.setItem('currentUser',JSON.stringify(user));
    }, [user])


    return (
        <AuthContext.Provider value={{
            user,
            dispatch
        }}>
            <Router>
                <div>

                    <Navbar />
                    <main className="container">

                        <Switch>
                            <Route path="/login" component={LoginScreen} />
                            <Route path="/*"> 
                                <PrivateRoutes>
                                    <HomeScreen />
                                </PrivateRoutes>
                            </Route>
                            <Redirect to="/" />
                        </Switch>
                    </main>
                </div>
            </Router>
        </AuthContext.Provider>
    )
}

Main.propTypes = {

}

export default Main

import React from 'react';
import Navbar from '../../components/Navbar';
import { Switch, Route, Redirect } from "react-router-dom";
import HomeScreen from '../Home/HomeScreen';
import Users from '../Users/Users';
import Blog from '../Blog/Blog';

const Dashboard = () => {
    return (
        <>
            <Navbar />
            <main className="container">
                <Switch>
                    {/* <Route path="/login" component={LoginScreen} /> */}
                    <Route path="/home" component={HomeScreen} />
                    <Route path="/users" component={Users} />
                    <Route path="/blog" component={Blog} />
                    <Redirect to="/home" />
                </Switch>
            </main>
        </>
    )
}

export default Dashboard

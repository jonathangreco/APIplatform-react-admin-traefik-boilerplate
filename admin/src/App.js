import * as React from "react";
import { Admin, Resource, ListGuesser } from 'react-admin';
import jsonServerProvider from 'ra-data-json-server';
import { HydraAdmin, ResourceGuesser} from "@api-platform/admin";

//const dataProvider = jsonServerProvider(process.env.REACT_APP_API_URL);
//const dataProvider = jsonServerProvider('https://jsonplaceholder.typicode.com');

const App = () => (
    <HydraAdmin entrypoint="https://jsonplaceholder.typicode.com">
        <Resource name={"users"} list={ListGuesser}/>
    </HydraAdmin>
);

export default App;

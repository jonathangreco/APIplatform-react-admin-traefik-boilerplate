import * as React from "react";
import { HydraAdmin } from '@api-platform/admin';

const App = () => (
    <HydraAdmin entrypoint={process.env.REACT_APP_API_URL}/>
);

export default App;

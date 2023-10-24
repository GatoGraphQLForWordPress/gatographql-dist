(window.webpackJsonpGatoGraphQLPersistedQueryEndpointOptions=window.webpackJsonpGatoGraphQLPersistedQueryEndpointOptions||[]).push([[2],{51:function(e,t){e.exports='<h1 id="persisted-queries">Persisted Queries</h1> <p>Use GraphQL queries to create pre-defined enpoints as in REST, obtaining the benefits from both APIs.</p> <h2 id="description">Description</h2> <p>With <strong>REST</strong>, you create multiple endpoints, each returning a pre-defined set of data.</p> <table> <thead> <tr> <th>Advantages</th> <th>Disadvantages</th> </tr> </thead> <tbody><tr> <td>✅ It&#39;s simple</td> <td>❌ It&#39;s tedious to create all the endpoints</td> </tr> <tr> <td>✅ Accessed via <code>GET</code> or <code>POST</code></td> <td>❌ A project may face bottlenecks waiting for endpoints to be ready</td> </tr> <tr> <td>✅ Can be cached on the server or CDN</td> <td>❌ Producing documentation is mandatory</td> </tr> <tr> <td>✅ It&#39;s secure: only intended data is exposed</td> <td>❌ It can be slow (mainly for mobile apps), since the application may need several requests to retrieve all the data</td> </tr> </tbody></table> <p>With <strong>GraphQL</strong>, you provide any query to a single endpoint, which returns exactly the requested data.</p> <table> <thead> <tr> <th>Advantages</th> <th>Disadvantages</th> </tr> </thead> <tbody><tr> <td>✅ No under/over fetching of data</td> <td>❌ Accessed only via <code>POST</code></td> </tr> <tr> <td>✅ It can be fast, since all data is retrieved in a single request</td> <td>❌ It can&#39;t be cached on the server or CDN, making it slower and more expensive than it could be</td> </tr> <tr> <td>✅ It enables rapid iteration of the project</td> <td>❌ It may require to reinvent the wheel, such as uploading files or caching</td> </tr> <tr> <td>✅ It can be self-documented</td> <td>❌ Must deal with additional complexities, such as the N+1 problem</td> </tr> <tr> <td>✅ It provides an editor for the query (GraphiQL) that simplifies the task</td> <td>&nbsp;</td> </tr> </tbody></table> <p><strong>Persisted queries</strong> combine these 2 approaches together:</p> <ul> <li>It uses GraphQL to create and resolve queries</li> <li>But instead of exposing a single endpoint, it exposes every pre-defined query under its own endpoint</li> </ul> <p>Hence, we obtain multiple endpoints with predefined data, as in REST, but these are created using GraphQL, obtaining the advantages from each and avoiding their disadvantages:</p> <table> <thead> <tr> <th>Advantages</th> <th>Disadvantages</th> </tr> </thead> <tbody> <tr> <td>✅ Accessed via <code>GET</code> or <code>POST</code></td> <td><s>❌ It\'s tedious to create all the endpoints</s></td> </tr> <tr> <td>✅ Can be cached on the server or CDN</td> <td><s>❌ A project may face bottlenecks waiting for endpoints to be ready</s></td> </tr> <tr> <td>✅ It\'s secure: only intended data is exposed</td> <td><s>❌ Producing documentation is mandatory</s></td> </tr> <tr> <td>✅ No under/over fetching of data</td> <td><s>❌ It can be slow (mainly for mobile apps), since the application may need several requests to retrieve all the data</s></td> </tr> <tr> <td>✅ It can be fast, since all data is retrieved in a single request</td> <td><s>❌ Accessed only via <code>POST</code></s></td> </tr> <tr> <td>✅ It enables rapid iteration of the project</td> <td><s>❌ It can\'t be cached on the server or CDN, making it slower and more expensive than it could be</s></td> </tr> <tr> <td>✅ It can be self-documented</td> <td><s>❌ It may require to reinvent the wheel , such asuploading files or caching</s></td> </tr> <tr> <td>✅ It provides an editor for the query (GraphiQL) that simplifies the task</td> <td><s>❌ Must deal with additional complexities, such as the N+1 problem</s> 👈🏻 this issue is [resolved by the underlying engine](https://graphql-by-pop.com/docs/architecture/suppressing-n-plus-one-problem.html)</td> </tr> </tbody> </table> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/persisted-query.png" alt="Persisted query editor" title="Persisted query editor"></p> <h2 id="executing-the-persisted-query">Executing the Persisted Query</h2> <p>Once the persisted query is published, we can execute it via its permalink.</p> <p>The persisted query can be executed directly in the browser, since it is accessed via <code>GET</code>, and we will obtain the requested data, in JSON format:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/persisted-query-execution.png" alt="Executing a persisted in the browser"></p> <h2 id="creating-a-persisted-query">Creating a Persisted Query</h2> <p>Clicking on the Persisted Queries link in the menu, it displays the list of all the created persisted queries:</p> <div class="img-width-1024" markdown="1"> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/persisted-queries-page.png" alt="Persisted Queries in the admin"></p> </div> <p>A persisted query is a custom post type (CPT). To create a new persisted query, click on button &quot;Add New GraphQL persisted query&quot;, which will open the WordPress editor:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/new-persisted-query.png" alt="Creating a new Persisted Query"></p> <p>The main input is the GraphiQL client, which comes with the Explorer by default. Clicking on the fields on the left side panel adds them to the query, and clicking on the &quot;Run&quot; button executes the query:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/graphiql-explorer.gif" alt="Writing and executing a persisted query"></p> <p>When the query is ready, publish it, and its permalink becomes its endpoint. The link to the endpoint (and to the source) is shown on the &quot;Persisted Query Endpoint Overview&quot; sidebar panel:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/persisted-query-endpoint-overview.png" alt="Persisted Query Endpoint Overview"></p> <p>Appending <code>?view=source</code> to the permalink, it will show the persisted query and its configuration (as long as the user is logged-in and the user role has access to it):</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/persisted-query-source.png" alt="Persisted query source"></p> <p>By default, the persisted query&#39;s endpoint has path <code>/graphql-query/</code>, and this value is configurable through the Settings:</p> <div class="img-width-1024" markdown="1"> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/settings-persisted-queries.png" alt="Persisted query Settings"></p> </div> <h3 id="schema-configuration">Schema configuration</h3> <p>Defining what elements the schema contains, and what access will users have to it, is defined in the schema configuration.</p> <p>So we must create a create a schema configuration, and then select it from the dropdown:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/select-schema-configuration.png" alt="Selecting the schema configuration"></p> <h3 id="organizing-persisted-queries-by-category">Organizing Persisted Queries by Category</h3> <p>On the sidebar panel &quot;Endpoint categories&quot; we can add categories to help manage the Persisted Query:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/graphql-persisted-query-editor-with-categories.png" alt="Endpoint categories when editing a Persisted Query"></p> <p>For instance, we can create categories to manage endpoints by client, application, or any other required piece of information:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/graphql-endpoint-categories.png" alt="List of endpoint categories"></p> <p>On the list of Persisted Queries, we can visualize their categories and, clicking on any category link, or using the filter at the top, will only display all entries for that category:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/graphql-persisted-queries-with-categories.png" alt="List of Persisted Queries with their categories"></p> <h3 id="private-persisted-queries">Private persisted queries</h3> <p>By setting the status of the Persisted Query as <code>private</code>, the endpoint can only be accessed by the admin user. This prevents our data from being unintentionally shared with users who should not have access to the data.</p> <p>For instance, we can create private Persisted Queries that help manage the application, such as retrieving data to create reports with our metrics.</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/private-persisted-query.png" alt="Private Persisted Query"></p> <h3 id="password-protected-persisted-queries">Password-protected persisted queries</h3> <p>If we create a Persisted Query for a specific client, we can assign a password to it, to provide an additional level of security that only that client will access the endpoint.</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/password-protected-persisted-query.png" alt="Password-protected Persisted Query"></p> <p>When first accessing a password-protected persisted query, we encounter a screen requesting the password:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/password-protected-persisted-query-unauthorized.png" alt="Password-protected Persisted Query: First access"></p> <p>Once the password is provided and validated, only then the user will access the intended endpoint.</p> <h3 id="making-the-persisted-query-dynamic-via-url-params">Making the persisted query dynamic via URL params</h3> <p>If the query makes use of variables, and option &quot;Accept variables as URL params?&quot; is enabled, then the values of the variables can be set via URL param when executing the persisted query.</p> <p>For instance, in this query, the number of results is controlled via variable <code>$limit</code>, with a default value of 3:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/new-persisted-query-variables.png" alt="Using variables in persisted query"></p> <p>When executing this persisted query, passing <code>?limit=5</code> will execute the query returning 5 results instead:</p> <p><img src="https://raw.githubusercontent.com/GatoGraphQL/GatoGraphQL/1.0.10/layers/GatoGraphQLForWP/plugins/gatographql/docs/modules/persisted-queries/../../images/executing-persisted-query-variables.png" alt="Overriding value for variables in persisted query"></p> <h2 id="editor-inputs">Editor Inputs</h2> <p>These inputs in the body of the editor are shipped with the plugin (more inputs can be added by extensions):</p> <table> <thead> <tr> <th>Input</th> <th>Description</th> </tr> </thead> <tbody> <tr> <td><strong>Title</strong></td> <td>Persisted query\'s title</td> </tr> <tr> <td><strong>GraphiQL client</strong></td> <td>Editor to write and execute the GraphQL query: <ul><li>Write the query on the textarea</li><li>Declare variables inside the query, and declare their values on the variables input at the bottom</li><li>Click on the "Run" button to execute the query</li><li>Obtain the results on the input on the right side</li><li>Click on "Docs" to inspect the schema information</li></ul>The Explorer (shown only if module <code>GraphiQL Explorer</code> is enabled) allows to click on the fields, and these are automatically added to the query</td> </tr> <tr> <td><strong>Schema configuration</strong></td> <td>From the dropdown, select the schema configuration that applies to the persisted query, or one of these options: <ul><li><code>"Default"</code>: the schema configuration is the one selected on the plugin\'s Settings</li><li><code>"None"</code>: the persisted query will be unconstrained</li><li><code>"Inherit from parent"</code>: Use the same schema configuration as the parent persisted query.<br/>This option is available when module <code>API Hierarchy</code> is enabled, and the persisted query has a parent query (selected on the Document settings)</li></ul></td> </tr> <tr> <td><strong>Options</strong></td> <td>Customize the behavior of the persisted query: <ul><li><strong>Enabled?:</strong> If the persisted query is enabled.<br/>It\'s useful to disable a persisted query it\'s a parent query in an API hierarchy</li><li><strong>Accept variables as URL params?:</strong> Allow URL params to override the values for variables defined in the GraphiQL client</li></ul></td> </tr> <tr> <td><strong>API Hierarchy:</strong></td> <td>Use the same query as the parent persisted query.<br/>This option is available when the persisted query has a parent query (selected on the Document settings)</td> </tr> </tbody> </table> <p>These are the inputs in the Document settings:</p> <table> <thead> <tr> <th>Input</th> <th>Description</th> </tr> </thead> <tbody><tr> <td><strong>Permalink</strong></td> <td>The endpoint under which the persisted query will be available</td> </tr> <tr> <td><strong>Categories</strong></td> <td>Can categorize the persisted query.<br/>Eg: <code>mobile</code>, <code>app</code>, etc</td> </tr> <tr> <td><strong>Excerpt</strong></td> <td>Provide a description for the persisted query.<br/>This input is available when module <code>Excerpt as Description</code> is enabled</td> </tr> <tr> <td><strong>Page attributes</strong></td> <td>Select a parent persisted query.<br/>This input is available when module <code>API Hierarchy</code> is enabled</td> </tr> </tbody></table> \x3c!-- ## Settings\n\n| Option | Description | \n| --- | --- |\n| **Endpoint base slug** | The base path for the custom endpoint URL. It defaults to `graphql-query` | --\x3e \x3c!-- ## Resources\n\nVideo showing how to create a persisted query: <a href="https://vimeo.com/443790273" target="_blank">vimeo.com/443790273</a>. --\x3e '}}]);
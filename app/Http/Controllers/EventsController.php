<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use DateTime;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //TESTING PAGINATED API
    public function index(Request $request)
    {
        $client = new Client();
        $graphQLendpoint = 'https://api.smash.gg/gql/alpha';
        $eventId= 78790;
        $perPage = 10;
        $page = 1;

        $date = new DateTime();
        $afterDate = $date->getTimestamp();

        // $afterDate = 1597208615;
        $state = 'CA';
        $cCode = "NA";
        $name = 'WNF2020 X Orange County Episode 10';


        try{
            $query = <<<GQL
            query {
                tournaments(query: {
                    page: $page,
                    perPage: $perPage,
                    sortBy: "startAt asc",
                    filter: {
                    countryCode: "US"
                    addrState: "CA"
                    afterDate: $afterDate
                    }
                }) {
                    pageInfo {
                        total,
                        totalPages,
                        page,
                        perPage
                    }
                    nodes {
                    id
                    name
                    countryCode
                    venueName
                    venueAddress
                    state
                    startAt
                    registrationClosesAt
                    numAttendees
                    slug
                    images {
                        url
                    }
                    url
                    }
                }
            }
            GQL;

            $res = $client->request(
            'POST',
            $graphQLendpoint,
            [
                'json' => [
                    'query' => $query,
                    'variables' => [
                        'page' => $page,
                        'perPage' => $perPage,
                        'countryCode' => $cCode,
                        'addrState' => $state,
                    ],
                    'operationName' => null
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
                    'Content-Type' => 'application/json'
                ]
            ]);
            $json = $res->getBody()->getContents();
            $array = json_decode($json);
            
            $totalPages = $array->data->tournaments->pageInfo->totalPages;
            $totalData = [];
            for ($page; $page <= $totalPages; $page++) { 
                $query = <<<GQL
                query {
                    tournaments(query: {
                        page: $page,
                        perPage: $perPage,
                        sortBy: "startAt asc",
                        filter: {
                        countryCode: "US"
                        addrState: "CA"
                        afterDate: $afterDate
                        }
                    }) {
                        pageInfo {
                            total,
                            totalPages,
                            page,
                            perPage
                        }
                        nodes {
                        id
                        name
                        countryCode
                        venueName
                        venueAddress
                        state
                        startAt
                        registrationClosesAt
                        numAttendees
                        slug
                        images {
                            url
                        }
                        url
                        }
                    }
                }
                GQL;
                $res = $client->request(
                    'POST',
                    $graphQLendpoint,
                    [
                        'json' => [
                            'query' => $query,
                            'variables' => [
                                'perPage' => $perPage,
                                'countryCode' => $cCode,
                                'addrState' => $state,
                            ],
                            'operationName' => null
                        ],
                        'headers' => [
                            'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
                            'Content-Type' => 'application/json'
                        ]
                    ]);
                $json = $res->getBody()->getContents();
                $array = json_decode($json);
                array_push($totalData, $array->data->tournaments->nodes);
            }
            $totalData = array_merge(...$totalData);
            return $totalData;
        }catch (\Exception $e){
            echo $e->getMessage();
            throw $e;
        }
    }

    // public function index()
    // {

    //     $client = new Client();
    //     // $res = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.23.1/data/en_US/champion.json');
    //     // $body = $res->getBody()->getContents();
    //     // return $body;
    //     $eventId= 78790;
    //     $perPage = 10;
    //     $page = 1;

    //     $afterDate = 1597208615;
    //     $state = 'CA';
    //     $cCode = "NA";
    //     $name = 'WNF2020 X Orange County Episode 10';

    //     $graphQLendpoint = 'https://api.smash.gg/gql/alpha';

    //     // WORKING API CALL FOR Tournaments by Location
    //     // https://smashgg-developer-portal.netlify.app/docs/examples/queries/tournaments-by-location

        
    //     $query = <<<GQL
    //     query {
    //         tournaments(query: {
    //             page: $i,
    //             perPage: $perPage,
    //             sortBy: "startAt asc",
    //             filter: {
    //               countryCode: "US"
    //               addrState: "CA"
    //               afterDate: $afterDate
    //             }
    //           }) {
    //             nodes {
    //               id
    //               name
    //               countryCode
    //               venueName
    //               venueAddress
    //               state
    //               startAt
    //               registrationClosesAt
    //               numAttendees
    //               slug
    //               images {
    //                 url
    //               }
    //               url
    //             }
    //           }
    //     }
    //     GQL;

    //     $res = $client->request(
    //     'POST',
    //     $graphQLendpoint,
    //     [
    //         'json' => [
    //             'query' => $query,
    //             'variables' => [
    //                 'perPage' => $perPage,
    //                 'countryCode' => $cCode,
    //                 'addrState' => $state,
    //             ],
    //             'operationName' => null
    //         ],
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    //             'Content-Type' => 'application/json'
    //         ]
    //     ]);
    //     // dd($res->getBody()->getContents());
    //     return $res->getBody()->getContents();

    //     // WORKING API CALL FOR EVENT STANDINGS
    //     //https://smashgg-developer-portal.netlify.app/docs/examples/queries/event-standings

    //     // $query = <<<GQL
    //     // query {
    //     //     event(id: $eventId) {
    //     //         id
    //     //         name
    //     //         standings(query: {
    //     //             perPage: $perPage,
    //     //             page: $page
    //     //         }){
    //     //                 nodes {
    //     //                 placement
    //     //                 entrant {
    //     //                     id
    //     //                     name
    //     //                 }
    //     //             }
    //     //         }
    //     //     }
    //     // }
    //     // GQL;

    //     // $res = $client->request(
    //     // 'POST',
    //     // $graphQLendpoint,
    //     // [
    //     //     'json' => [
    //     //         'query' => $query,
    //     //         'variables' => [
    //     //             'perPage' => $perPage,
    //     //             'eventId' => $eventId,
    //     //             'page' => $page,
    //     //         ],
    //     //         'operationName' => null
    //     //     ],
    //     //     'headers' => [
    //     //         'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    //     //         'Content-Type' => 'application/json'
    //     //     ]
    //     // ]);

    //     // dd($res->getBody()->getContents());



    //     // $query = <<<GQL
    //     // query {
    //     //     event(id: $id) {
    //     //         id
    //     //         name
    //     //     }
    //     // }
    //     // GQL;

    //     // $res = $client->request(
    //     // 'POST',
    //     // $graphQLendpoint,
    //     // [
    //     //     'json' => [
    //     //         'query' => $query,
    //     //         'variables' => [
    //     //             'id' => $id
    //     //         ],
    //     //         'operationName' => null
    //     //     ],
    //     //     'headers' => [
    //     //         'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    //     //         'Content-Type' => 'application/json'
    //     //     ]
    //     // ]);

    //     // dd($res->getBody()->getContents());


    // //     $query = "
    // //     query TournamentsByCountry($cCode: String!, $perPage: Int) {
    // //         tournaments(query: {
    // //             perPage: 
    // //             filter: {
    // //             countryCode: 'US'
    // //         }
    // //     })
    // //         {
    // //             nodes {
    // //                 id
    // //                 name
    // //                 countryCode
    // //             }
    // //         }
    // //     }";

    // //     $res = $client->request(
    // //         'POST',
    // //         $graphQLendpoint,
    // //         [
    // //             'json' => [
    // //                 'query' => $query,
    // //                 'variables' => [
    // //                     "perPage" => 3,
    // //                     "cCode" => 'US',
    // //                 ],
    // //                 'operationName' => null
    // //             ],
    // //             'headers' => [
    // //                 'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    // //                 'Content-Type' => 'application/json'
    // //             ]
    // //         ]);


    // //         dd($res->getBody()->getContents());


    // //     // $graphQLquery = '{"query": "query { viewer { repositories(last: 100) { nodes { name id isPrivate nameWithOwner } } } } "}';


    // //     $response = (new Client)->request('post', '{graphql-endpoint}', [
    // //         'headers' => [
    // //             'Authorization' => 'bearer ' . $token,
    // //             'Content-Type' => 'application/json'
    // //         ],
    // //         'body' => $graphQLquery
    // //     ]);

    // //     $graphQLquery = 
    // //         '{
    // //             "query {
    // //                 filter: {
    // //                   videogameIds: [3200]
    // //                   upcoming: false
    // //                   hasOnlineEvents: false
    // //                   afterDate: $afterDate
    // //                   countryCode: $cCode
    // //                   addrState: $state
    // //                 }
    // //               }) {
    // //                 nodes {
    // //                   id
    // //                   name
    // //                   countryCode
    // //                   endAt
    // //                   events {
    // //                     id
    // //                     name
    // //                     isOnline
    // //                     numEntrants
    // //                     type
    // //                     videogame {
    // //                       id
    // //                     }
    // //                   }
    // //                 }
    // //             }"      
    // //         }';

    // //     $response = (new Client)->request('post', $graphQLendpoint, [
    // //         'headers' => [
    // //             'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    // //             'Content-Type' => 'application/json'
    // //         ],
    // //         'body' => $graphQLquery
    // //     ]);

    // //     dd($response);

    // //     return $response->getBody()->getContents();

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $currentPage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // dd(\Request::query());
        // dd($totalParticipants);
        // dd($request->all());
        // dd($request->input('ID'));
        // if(empty($data)) {
        //     $data = json_decode($request->getContent());
        //     $data = json_decode($data);
        
        //     if(is_null($data)) {
        //         return response()->json("Not valid json", 400);
        //     }
        // }
        $client = new Client();
        // dd($id);
        // dd($request->get('currentPage'));
        // $res = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/9.23.1/data/en_US/champion.json');
        // $body = $res->getBody()->getContents();
        // return $body;
        $eventId= 78790;
        $perPage = 10;
        $page = 1;

        $afterDate = 1577923043;
        $state = 'CA';
        $cCode = "NA";
        $name = 'WNF2020 X Orange County Episode 10';

        $graphQLendpoint = 'https://api.smash.gg/gql/alpha';


        // WORKING API CALL FOR Tournaments by Location
        // https://smashgg-developer-portal.netlify.app/docs/examples/queries/tournaments-by-location

        $query = <<<GQL
        query {
            tournament(
                id: $id
            ) {
                venueAddress,
                startAt,
                endAt,
                addrState,
                events {
                    id,
                    name,
                    matchRulesMarkdown,
                    prizingInfo,
                    rulesMarkdown,
                    videogame {
                        images {
                            url
                        }
                    },
                },
                images {
                    url
                },
                name,
                links{
                    discord,
                    facebook
                },
                owner{
                    name,
                    bio
                },
                primaryContact,
                participants(query: {
                    perPage: 20,
                }) {
                    pageInfo {
                        total,
                        totalPages,
                        page,
                        perPage
                    }
                    nodes {
                        gamerTag,
                        checkedIn,
                        images{
                            url,
                            type
                        },
                        entrants{
                            event {
                                name
                            }
                            skill,
                            participants{
                                gamerTag
                            },
                            seeds{
                                seedNum
                            },
                            standing{
                                placement
                            }
                        },
                        verified
                    }
                },
                rules,
                streams{
                    id,
                    enabled,
                    followerCount,
                    isOnline,
                    numSetups,
                    parentStreamId,
                    streamGame,
                    streamName
                }
            }
        }
        GQL;

        // owner,
        // participants,
        // primaryContact,
        // rules,
        // streams

        // $res = $client->request(
        // 'POST',
        // $graphQLendpoint,
        // [
        //     'json' => [
        //         'query' => $query,
        //         'variables' => [
        //             'id' => $id,
        //         ],
        //         'operationName' => null
        //     ],
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
        //         'Content-Type' => 'application/x-www-form-urlencoded'
        //     ]
        // ]);
        // dd($obj);

        $res = $client->request(
            'POST',
            $graphQLendpoint,
            [
                'json' => [
                    'query' => $query,
                    'variables' => [
                        'page' => $page,
                        'perPage' => $perPage,
                    ],
                    'operationName' => null
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
                    'Content-Type' => 'application/json'
                ]
            ]);
            $json = $res->getBody()->getContents();
            // dd($json);
            $array = json_decode($json);
            // dd($array);
            
            $totalPages = $array->data->tournament->participants->pageInfo->totalPages;
            $totalParticipants = [];
            for ($page; $page <= $totalPages; $page++) { 
                $query = <<<GQL
                query {
                    tournament(
                        id: $id
                    ) {
                        participants(query: {
                            perPage: 20,
                            page: $page,
                        }) {
                            pageInfo {
                                total,
                                totalPages,
                                page,
                                perPage
                            }
                            nodes {
                                gamerTag,
                                checkedIn,
                                images{
                                    url,
                                    type
                                },
                                entrants{
                                    event {
                                        name
                                    }
                                    skill,
                                    participants{
                                        gamerTag
                                    },
                                    seeds{
                                        seedNum
                                    },
                                    standing{
                                        placement
                                    }
                                },
                                verified
                            }
                        },
                    }
                }
                GQL;
                $res = $client->request(
                    'POST',
                    $graphQLendpoint,
                    [
                        'json' => [
                            'query' => $query,
                            'variables' => [
                                'id' => $id,
                            ],
                            'operationName' => null
                        ],
                        'headers' => [
                            'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
                            'Content-Type' => 'application/json'
                        ]
                    ]);
                $json = $res->getBody()->getContents();
                $participants_array = json_decode($json);
                // dd($array);
                array_push($totalParticipants, $participants_array->data->tournament->participants->nodes);
            }
            $totalParticipants = array_merge(...$totalParticipants);
            $array->data->tournament->participants->nodes = $totalParticipants;
        // dd($array);
        return json_encode($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

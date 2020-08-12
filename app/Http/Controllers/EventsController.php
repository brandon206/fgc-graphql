<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
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
            tournaments(query: {
                perPage: $perPage
                filter: {
                  countryCode: "US"
                }
              }) {
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
                ],
                'operationName' => null
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
                'Content-Type' => 'application/json'
            ]
        ]);

        return $res->getBody()->getContents();

        // WORKING API CALL FOR EVENT STANDINGS
        //https://smashgg-developer-portal.netlify.app/docs/examples/queries/event-standings

        // $query = <<<GQL
        // query {
        //     event(id: $eventId) {
        //         id
        //         name
        //         standings(query: {
        //             perPage: $perPage,
        //             page: $page
        //         }){
        //                 nodes {
        //                 placement
        //                 entrant {
        //                     id
        //                     name
        //                 }
        //             }
        //         }
        //     }
        // }
        // GQL;

        // $res = $client->request(
        // 'POST',
        // $graphQLendpoint,
        // [
        //     'json' => [
        //         'query' => $query,
        //         'variables' => [
        //             'perPage' => $perPage,
        //             'eventId' => $eventId,
        //             'page' => $page,
        //         ],
        //         'operationName' => null
        //     ],
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
        //         'Content-Type' => 'application/json'
        //     ]
        // ]);

        // dd($res->getBody()->getContents());



        // $query = <<<GQL
        // query {
        //     event(id: $id) {
        //         id
        //         name
        //     }
        // }
        // GQL;

        // $res = $client->request(
        // 'POST',
        // $graphQLendpoint,
        // [
        //     'json' => [
        //         'query' => $query,
        //         'variables' => [
        //             'id' => $id
        //         ],
        //         'operationName' => null
        //     ],
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
        //         'Content-Type' => 'application/json'
        //     ]
        // ]);

        // dd($res->getBody()->getContents());


    //     $query = "
    //     query TournamentsByCountry($cCode: String!, $perPage: Int) {
    //         tournaments(query: {
    //             perPage: 
    //             filter: {
    //             countryCode: 'US'
    //         }
    //     })
    //         {
    //             nodes {
    //                 id
    //                 name
    //                 countryCode
    //             }
    //         }
    //     }";

    //     $res = $client->request(
    //         'POST',
    //         $graphQLendpoint,
    //         [
    //             'json' => [
    //                 'query' => $query,
    //                 'variables' => [
    //                     "perPage" => 3,
    //                     "cCode" => 'US',
    //                 ],
    //                 'operationName' => null
    //             ],
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    //                 'Content-Type' => 'application/json'
    //             ]
    //         ]);


    //         dd($res->getBody()->getContents());


    //     // $graphQLquery = '{"query": "query { viewer { repositories(last: 100) { nodes { name id isPrivate nameWithOwner } } } } "}';


    //     $response = (new Client)->request('post', '{graphql-endpoint}', [
    //         'headers' => [
    //             'Authorization' => 'bearer ' . $token,
    //             'Content-Type' => 'application/json'
    //         ],
    //         'body' => $graphQLquery
    //     ]);

    //     $graphQLquery = 
    //         '{
    //             "query {
    //                 filter: {
    //                   videogameIds: [3200]
    //                   upcoming: false
    //                   hasOnlineEvents: false
    //                   afterDate: $afterDate
    //                   countryCode: $cCode
    //                   addrState: $state
    //                 }
    //               }) {
    //                 nodes {
    //                   id
    //                   name
    //                   countryCode
    //                   endAt
    //                   events {
    //                     id
    //                     name
    //                     isOnline
    //                     numEntrants
    //                     type
    //                     videogame {
    //                       id
    //                     }
    //                   }
    //                 }
    //             }"      
    //         }';

    //     $response = (new Client)->request('post', $graphQLendpoint, [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . env('SMASH_GG_TOKEN'),
    //             'Content-Type' => 'application/json'
    //         ],
    //         'body' => $graphQLquery
    //     ]);

    //     dd($response);

    //     return $response->getBody()->getContents();

    }

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
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        // dd($obj);

        // dd($res->getBody()->getContents());

        return $res->getBody()->getContents();
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $currentPage
     * @return \Illuminate\Http\Response
     */
    public function getEventData(Request $request, $id, $totalParticipants)
    {
        // dd(\Request::query());
        dd($request->all());
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
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        // dd($obj);

        dd($res->getBody()->getContents());

        return $res->getBody()->getContents();
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

import { useEffect, useRef, useState } from 'react';
import Calendar from './calendar';
import axios from 'axios';

export default function Booking(props) {
    const trans = JSON.parse(props.trans);

    const form = useRef();

    const [times, setTimes] = useState(JSON.parse(props.times));
    const [errors, setErrors] = useState({});
    const [booking, setBooking] = useState({});
    const [validated, setValidated] = useState({});
    const submit = useRef();















    const [currentStep, setCurrentStep] = useState(0);

    const goToNextStep = () => {
        setErrors({});
        setCurrentStep(currentStep + 1);
    }

    const goToPreviousStep = (e) => {
        e.preventDefault();

        setErrors({});
        setCurrentStep(currentStep - 1);
    }






    const from_location_autocomplete = useRef();
    const to_location_autocomplete = useRef();

    const from_location_autocomplete_input = useRef();
    const to_location_autocomplete_input = useRef();

    const initMap = () => {
        const google = window.google;

        const center = {
            lat: 48.8589384,
            lng: 2.2646341,
        };

        const options = {
            // bounds: {
            //     north: center.lat + 3,
            //     south: center.lat - 3,
            //     east: center.lng + 3,
            //     west: center.lng - 3,
            // },
            // strictBounds: true,
            componentRestrictions: {
                country: 'fr',
            },
            fields: [
                'name',
                'place_id',
            ],
        };

        from_location_autocomplete.current = new google.maps.places.Autocomplete(from_location_autocomplete_input.current, options);

        from_location_autocomplete.current.addListener('place_changed', () => {
            const place = from_location_autocomplete.current.getPlace();

            handleChange({name: 'from_location', value: place.place_id});
            handleChange({name: 'from_location_autocomplete_input', value: place.name});
        });

        to_location_autocomplete.current = new google.maps.places.Autocomplete(to_location_autocomplete_input.current, options);

        to_location_autocomplete.current.addListener('place_changed', () => {
            const place = to_location_autocomplete.current.getPlace();

            handleChange({name: 'to_location', value: place.place_id});
            handleChange({name: 'to_location_autocomplete_input', value: place.name});
        });
    };

    useEffect(() => {
        initMap();
    }, []);

    useEffect(() => {
        initMap();
    }, [currentStep]);






    useEffect(() => {
        const formData = new FormData(form.current);
        const values = Object.fromEntries(formData.entries());

        setBooking({...booking, ...values});
    }, [currentStep]);

    const handleChange = (e) => {
        const name = e.name || e.target.name;
        const value = e.value || e.target.value;

        setBooking((booking) => {
            return {...booking, [name]: value};
        });
    };









    const handleSubmit = async (e) => {
        e.preventDefault();

        const button = submit.current;

        button.querySelector('span').classList.add('hidden');
        button.querySelector('svg').classList.remove('hidden');

        const fetch = await axios.post('/booking', booking)
            .then(function (response) {
                setValidated({...validated, ...response.data});

                goToNextStep();
            })
            .catch((error) => {
                setErrors(error.response.data.errors);
            })
            .finally(() => {
                window.scrollTo(0, 0);

                button.querySelector('span').classList.remove('hidden');
                button.querySelector('svg').classList.add('hidden');
            });
    }

    return (
        <>
            {/* <div className="mx-auto mt-20 mb-10">
                <nav className="flex items-center justify-center" aria-label="Progress">
                    <p className="text-sm font-medium">Step 2 of 4</p>
                    <ol role="list" className="ml-8 flex items-center space-x-5">
                        {[0, 1, 2, 3].map((e) => {
                            return (
                                <li>
                                    <a href="#" className="block h-2.5 w-2.5 rounded-full bg-indigo-600"></a>
                                </li>
                            )
                        })}
                        <li>
                            <a href="#" className="relative flex items-center justify-center" aria-current="step">
                                <span className="absolute flex h-5 w-5 p-px" aria-hidden="true">
                                    <span className="h-full w-full rounded-full bg-indigo-200"></span>
                                </span>
                                <span className="relative block h-2.5 w-2.5 rounded-full bg-indigo-600" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" className="block h-2.5 w-2.5 rounded-full bg-gray-200"></a>
                        </li>
                    </ol>
                </nav>
            </div> */}
            <form method="post" autoComplete="off" ref={form} onSubmit={handleSubmit}>
                <input type="hidden" name="step" value={currentStep} />
                <div className="grid gap-x-6 gap-y-8">
                    {currentStep === 0 ? (
                        <>
                            <h2 className="text-lg font-semibold text-gray-900">{trans['booking.fill.title']}</h2>
                            {/* <p className="mt-2 text-sm text-gray-700 mb-10">{trans['booking.fill.description']}</p> */}
                            <div className="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['from']}</label>
                                    <input
                                        type="text"
                                        name="from_location_autocomplete_input"
                                        className="block w-full appearance-none rounded border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                        value={booking.from_location_autocomplete_input}
                                        placeholder={trans['enter.location']}
                                        onChange={handleChange}
                                        ref={from_location_autocomplete_input}
                                    />
                                    {errors.from_location ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.from_location}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['to']}</label>
                                    <input
                                        type="text"
                                        name="to_location_autocomplete_input"
                                        className="block w-full appearance-none rounded border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                        value={booking.to_location_autocomplete_input}
                                        placeholder={trans['enter.location']}
                                        onChange={handleChange}
                                        ref={to_location_autocomplete_input}
                                    />
                                    {errors.to_location ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.to_location}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['adults']}</label>
                                    <select
                                        name="adults"
                                        className="block w-full appearance-none rounded border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                        value={booking.adults}
                                        onChange={handleChange}
                                    >
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                    </select>
                                    {errors.adults ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.adults}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['children']}</label>
                                    <select
                                        name="children"
                                        className="block w-full appearance-none rounded border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                        value={booking.children}
                                        onChange={handleChange}
                                    >
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                    </select>
                                    {errors.children ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.children}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['voucher']}</label>
                                    <input
                                        type="text"
                                        name="voucher"
                                        className="block w-full appearance-none rounded border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                        value={booking.voucher}
                                        onChange={handleChange}
                                    />
                                    {errors.voucher ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.voucher}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                            </div>
                        </>
                    ) : (
                        <></>
                    )}
                    {currentStep === 1 ? (
                        <>
                            <h2 className="text-lg font-semibold text-gray-900">{trans['booking.price.title']}</h2>
                            <div className="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                                {validated.data && validated.data.location ? (
                                    <>
                                        <div className="col-span-full">
                                            <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['from']}</label>
                                            <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.location.from_address}</span>
                                        </div>
                                        <div className="col-span-full">
                                            <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['to']}</label>
                                            <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.location.to_address}</span>
                                        </div>
                                    </>
                                ) : (
                                    <></>
                                )}
                                {validated.data && validated.data.amount ? (
                                    <>
                                        <div className="col-span-full">
                                            <dl className="mt-5 text-sm font-medium text-gray-500 space-y-6">
                                                <div className="flex justify-between">
                                                    <dt>{trans['subtotal']}</dt>
                                                    <dd className="text-gray-900">{validated.data.amount}</dd>
                                                </div>
                                                {validated.data.voucher ? (
                                                    <>
                                                        <div className="flex justify-between">
                                                            <dt className="flex">{trans['voucher']}<span className="ml-2 rounded-full bg-gray-200 px-2 py-0.5 text-xs tracking-wide text-gray-600">{validated.data.voucher.code}</span></dt>
                                                            <dd className="text-gray-900">-{validated.data.voucher.amount}</dd>
                                                        </div>
                                                    </>
                                                ) : (
                                                    <></>
                                                )}
                                                <div className="flex items-center justify-between border-t border-gray-200 pt-6 text-gray-900">
                                                    <dt>{trans['total']}</dt>
                                                    <dd>{validated.data.amountWithVoucher}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </>
                                ) : (
                                    <></>
                                )}
                            </div>
                        </>
                    ) : (
                        <></>
                    )}
                    {currentStep === 2 ? (
                        <>
                            <h2 className="text-lg font-semibold text-gray-900">{trans['booking.date.title']}</h2>
                            <div>
                                <Calendar
                                    value={booking.from_date}
                                    onChange={handleChange}
                                />
                                {errors.from_date ? (
                                    <p className="mt-2 text-sm text-red-600">{errors.from_date}</p>
                                ) : (
                                    <></>
                                )}
                            </div>
                        </>
                    ) : (
                        <></>
                    )}
                    {currentStep === 3 ? (
                        <>
                            <h2 className="text-lg font-semibold text-gray-900">{trans['booking.contact.title']}</h2>
                            <div className="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['time']}</label>
                                    <select
                                        name="from_time"
                                        className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                        value={booking.from_time}
                                        onChange={handleChange}
                                    >
                                        <option disabled selected>{trans['select']}</option>
                                        {times.map((v, i) => <option key={i}>{v}</option>)}
                                    </select>
                                    {errors.from_time ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.from_time}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['luggages']}</label>
                                    <select
                                        name="luggages"
                                        className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                        value={booking.luggages}
                                        onChange={handleChange}
                                    >
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                    {errors.luggages ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.luggages}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['firstname']}</label>
                                    <input
                                        type="text"
                                        name="name"
                                        className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                        value={booking.name}
                                        onChange={handleChange}
                                    />
                                    {errors.name ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.name}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-700 text-nowrap">{trans['mobile']}</label>
                                    <input
                                        type="tel"
                                        name="phone"
                                        className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                        value={booking.phone}
                                        onChange={handleChange}
                                        placeholder="+33"
                                    />
                                    {errors.phone ? (
                                        <p className="mt-2 text-sm text-red-600">{errors.phone}</p>
                                    ) : (
                                        <></>
                                    )}
                                </div>
                            </div>
                        </>
                    ) : (
                        <></>
                    )}
                    {currentStep === 4 ? (
                        <>
                            <h2 className="text-lg font-semibold text-gray-900">{trans['booking.checkout.title']}</h2>
                            <div className="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['from']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.location.from_address}</span>
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['to']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.location.to_address}</span>
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['adults']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.adults}</span>
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['children']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.children}</span>
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['luggages']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.luggages}</span>
                                </div>
                                <div></div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['date']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.from_date.format}</span>
                                </div>
                                <div>
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['time']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.from_time.format}</span>
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['firstname']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.name}</span>
                                </div>
                                <div className="col-span-full">
                                    <label className="mb-3 block text-sm font-medium text-gray-500 text-nowrap">{trans['mobile']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">{validated.data.phone}</span>
                                </div>
                            </div>
                        </>
                    ) : (
                        <></>
                    )}
                    {currentStep === 5 ? (
                        <>
                            <h2 className="text-lg font-semibold text-gray-900">{trans['booking.confirmed.title']}</h2>
                            <p className="mt-2 text-sm text-gray-700 mb-10">{trans['booking.confirmed.description']}</p>
                            {/* <div className="col-span-full text-sm leading-6">
                                <div className="bg-green-50 rounded-lg p-6 text-green-900">
                                    <h2>{trans['booking.confirmed.title']}</h2>
                                    <p>{trans['booking.confirmed.description']}</p>
                                </div>
                            </div> */}
                            <div>
                                <a
                                    href={validated.stripe_url}
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full gap-1"
                                    variant="solid"
                                    color="white"
                                    target="_blank"
                                    rel="noreferrer"
                                >{trans['pay.now']}</a>
                            </div>
                            <div>
                                <a
                                    href="/"
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-gray-50 text-gray-700 hover:bg-gray-100 active:bg-gray-200 focus-visible:outline-blue-600 w-full gap-1"
                                    variant="solid"
                                    color="white"
                                >{trans['pay.later']}</a>
                            </div>
                        </>
                    ) : (
                        <></>
                    )}

                    {currentStep < 5 ?
                        <>
                            {currentStep === 0 ?
                                <div>
                                    <button
                                        className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-gray-50 text-gray-700 hover:bg-gray-100 active:bg-gray-200 focus-visible:outline-blue-600 w-full gap-1"
                                        type="submit"
                                        variant="solid"
                                        color="white"
                                    >
                                        <span>
                                            {trans['step.price']}
                                        </span>
                                    </button>
                                </div>
                            :
                                <></>
                            }
                            <div>
                                <button
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full gap-1"
                                    type="submit"
                                    variant="solid"
                                    color="blue"
                                    ref={submit}
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" className="w-5 h-5 animate-spin hidden">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    <span>
                                        {currentStep === 4 ? (
                                            trans['booking.confirm']
                                        ) : (
                                            <>
                                                {currentStep === 0 ? (
                                                    trans['book']
                                                ) : (
                                                    trans['step.next']
                                                )}
                                            </>
                                        )}
                                    </span>
                                </button>
                            </div>
                            {currentStep > 0 ?
                                <div>
                                    <a
                                        href=""
                                        className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-gray-50 text-gray-700 hover:bg-gray-100 active:bg-gray-200 focus-visible:outline-blue-600 w-full gap-1"
                                        variant="solid"
                                        color="white"
                                        onClick={goToPreviousStep}
                                    >{trans['step.back']}</a>
                                </div>
                            :
                                <></>
                            }
                        </>
                    :
                        <></>
                    }
                </div>
            </form>
        </>
    )
}

import { useEffect, useRef, useState } from 'react';
import Calendar from './calendar';
import axios from 'axios';

export default function Booking(props) {
    const trans = JSON.parse(props.trans);
    const prices = JSON.parse(props.prices);

    const form = useRef();
    const [inputs, setInputs] = useState(JSON.parse(props.inputs));

    const [checkout, setCheckout] = useState(false);
    const [locations, setLocations] = useState(JSON.parse(props.locations));
    const [times, setTimes] = useState(JSON.parse(props.times));
    const [errors, setErrors] = useState([]);
    const [price, setPrice] = useState(false);








    const [currentStep, _setCurrentStep] = useState(0); // TODO : maybe change to let variable

    const steps = useRef([]);

    const addStep = (el) => {
        steps.current.push(el);
    }
    
    const setCurrentStep = (i) => {
        if (
            (i < 0)
            || (i > steps.current.length - 1)
        ) {
            return;
        }

        _setCurrentStep(i);

        steps.current.forEach((item, index) => {
            if (i === index) {
                item.classList.remove('hidden');

                return;
            }

            item.classList.add('hidden');
        });
    }

    const goToNextStep = () => {
        setCurrentStep(currentStep + 1);
    }

    const goToPreviousStep = (e) => {
        e.preventDefault();

        setCurrentStep(currentStep - 1);
    }

    useEffect(() => {
        setCurrentStep(currentStep);
    }, []);








    const handleChange = (e) => {
        setInputs({...inputs, [e.target.name]: e.target.value});
    }

    const handleSubmit = async (e) => {
        e.preventDefault();

        const fetch = await axios.post('/booking', inputs)
            .then(function (response) {
                goToNextStep();
            })
            .catch((error) => {
                let messages = [];

                for (let message in error.response.data.errors) {
                    messages = [...messages, error.response.data.errors[message][0]];
                }

                setErrors(messages);
            })
            .finally(() => {
                window.scrollTo(0, 0); // TODO : keep or no ?
            });
    }

    const handleCancel = (e) => {
        e.preventDefault();

        setInputs({...inputs, step: inputs.step - 1});
    }

    useEffect(() => {
        const formData = new FormData(form.current);
        const values = Object.fromEntries(formData.entries());
        console.log(values)

        setInputs({...inputs, ...values});
    }, []);

    useEffect(() => {
        const newPrice = prices.find((e) => {
            return (
                e.from_location_id == inputs.from_location_id
                && e.to_location_id == inputs.to_location_id
            )
            || (
                e.from_location_id == inputs.to_location_id
                && e.to_location_id == inputs.from_location_id
            );
        });

        if (newPrice) {
            setPrice(newPrice.format);

            return;
        }
        
        setPrice(false);
    }, [inputs]);

    return (
        <>
            <form method="post" className="mt-20" autoComplete="off" ref={form} onSubmit={handleSubmit}>
                <input type="hidden" name="step" value={currentStep} />
                <div className="grid gap-x-6 gap-y-8">
                    <div ref={(el) => steps.current[0] = el}>
                        <h2 className="text-lg font-semibold text-gray-900">{trans['booking.fill.title']}</h2>
                        <p className="mt-2 text-sm text-gray-700 mb-10">{trans['booking.fill.description']}</p>
                        <div className="grid gap-x-6 gap-y-8">
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['from']}</label>
                                <select
                                    name="from_location_id"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.from_location_id}
                                >
                                    <option disabled selected>{trans['select']}</option>
                                    {locations.map((v, i) => <option value={v.id} key={i}>{v.name}</option>)}
                                </select>
                            </div>
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['to']}</label>
                                <select
                                    name="to_location_id"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.to_location_id}
                                >
                                    <option disabled selected>{trans['select']}</option>
                                    {locations.map((v, i) => <option value={v.id} key={i}>{v.name}</option>)}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div ref={(el) => steps.current[1] = el}>
                        <h2 className="text-lg font-semibold text-gray-900">{trans['booking.fill.title']}</h2>
                        <p className="mt-2 text-sm text-gray-700 mb-10">{trans['booking.fill.description']}</p>
                        <div>
                            <Calendar
                                onChange={handleChange}
                                value={inputs.from_date}
                            />
                        </div>
                    </div>
                    <div ref={(el) => steps.current[2] = el}>
                        <h2 className="text-lg font-semibold text-gray-900">{trans['booking.fill.title']}</h2>
                        <p className="mt-2 text-sm text-gray-700 mb-10">{trans['booking.fill.description']}</p>
                        <div className="grid gap-x-6 gap-y-8">
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['time']}</label>
                                <select
                                    name="from_time"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.from_time}
                                >
                                    <option disabled selected>{trans['select.time']}</option>
                                    {times.map((v, i) => <option key={i}>{v}</option>)}
                                </select>
                            </div>
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['adults']}</label>
                                <select
                                    name="adults"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.adults}
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
                            </div>
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['children']}</label>
                                <select
                                    name="children"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.children}
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
                            </div>
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['luggages']}</label>
                                <select
                                    name="luggages"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.luggages}
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
                            </div>
                        </div>
                    </div>
                    <div ref={(el) => steps.current[3] = el}>
                        <h2 className="text-lg font-semibold text-gray-900">{trans['booking.fill.title']}</h2>
                        <p className="mt-2 text-sm text-gray-700 mb-10">{trans['booking.fill.description']}</p>
                        <div className="grid gap-x-6 gap-y-8">
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['firstname']}</label>
                                <input
                                    type="text"
                                    name="name"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                    onChange={handleChange}
                                    value={inputs.name}
                                />
                            </div>
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['mobile']}</label>
                                <input
                                    type="tel"
                                    name="phone"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                    onChange={handleChange}
                                    value={inputs.phone}
                                    placeholder="+33"
                                />
                            </div>
                            <div>
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['voucher']}</label>
                                <input
                                    type="text"
                                    name="voucher"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                    onChange={handleChange}
                                    value={inputs.voucher}
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <button
                            className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full"
                            type="submit"
                            variant="solid"
                            color="blue"
                        >
                            {currentStep === steps.current.length - 1 ?
                                trans['confirm.my.booking']
                            :
                                trans['next']
                            }
                        </button>
                    </div>
                    {currentStep > 0 ?
                        <div>
                            <a
                                href=""
                                className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 active:text-slate-600 focus-visible:outline-white w-full"
                                variant="solid"
                                color="white"
                                onClick={goToPreviousStep}
                            >{trans['back']}</a>
                        </div>
                    :
                        <></>
                    }
                </div>
            </form>




















            {inputs.step === 2 ?
                <>
                    <div className="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                        <div className="col-span-full text-sm leading-6">
                            <div className="bg-green-50 rounded-lg p-6 text-green-900">{trans['booking.confirmed.title']}</div>
                        </div>
                        <div className="col-span-full">
                            <a
                                href="/"
                                className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full"
                                variant="solid"
                                color="blue"
                            >{trans['back.to.home']}</a>
                        </div>
                    </div>
                </>
            :
                <>
                    <h2 className="mt-20 text-lg font-semibold text-gray-900">
                        {!inputs.step ?
                            <>
                                {trans['booking.fill.title']}
                            </>
                        :
                            <>
                                {trans['booking.checkout.title']}
                            </>
                        }
                    </h2>
                    <p className="mt-2 text-sm text-gray-700">
                        {!inputs.step ?
                            <>
                                {trans['booking.fill.description']}
                            </>
                        :
                            <>
                                {trans['booking.checkout.description']}
                            </>
                        }
                    </p>
                    <form method="post" className="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2" autoComplete="off" onSubmit={handleSubmit}>
                        {!inputs.step && errors.length ?
                            <div className="col-span-full text-sm leading-6">
                                <div className="bg-red-50 rounded-lg p-6 text-red-900">
                                    <ul>
                                        {errors.map((v, i) => <li key={i}>{v}</li>)}
                                    </ul>
                                </div>
                            </div>
                        : ''}
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['from']}</label>
                            {!inputs.step ?
                                <select
                                    name="from_location_id"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.from_location_id}
                                >
                                    <option disabled selected>{trans['select']}</option>
                                    {locations.map((v, i) => <option value={v.id} key={i}>{v.name}</option>)}
                                </select>
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.from_location.name}
                                </span>
                            }
                        </div>
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">
                                {!inputs.step ?
                                    <>
                                        &nbsp;
                                    </>
                                :
                                    <>
                                        {trans['time']}
                                    </>
                                }
                            </label>
                            {!inputs.step ?
                                <select
                                    name="from_time"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.from_time}
                                >
                                    <option disabled selected>{trans['select.time']}</option>
                                    {times.map((v, i) => <option key={i}>{v}</option>)}
                                </select>
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.from_time}
                                </span>
                            }
                        </div>
                        <div className="col-span-full">
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['to']}</label>
                            {!inputs.step ?
                                <select
                                    name="to_location_id"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.to_location_id}
                                >
                                    <option disabled selected>{trans['select']}</option>
                                    {locations.map((v, i) => <option value={v.id} key={i}>{v.name}</option>)}
                                </select>
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.to_location.name}
                                </span>
                            }
                        </div>
                        <div className="col-span-full">
                            {!inputs.step ?
                                <Calendar
                                    onChange={handleChange}
                                    value={inputs.from_date}
                                />
                            :
                                <>
                                    <label className="mb-3 block text-sm font-medium text-gray-700">{trans['date']}</label>
                                    <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                        {checkout.from_date.format}
                                    </span>
                                </>
                            }
                        </div>
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['adults']}</label>
                            {!inputs.step ?
                                <select
                                    name="adults"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.adults}
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
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.adults}
                                </span>
                            }
                        </div>
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['children']}</label>
                            {!inputs.step ?
                                <select
                                    name="children"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.children}
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
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.children}
                                </span>
                            }
                        </div>
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['luggages']}</label>
                            {!inputs.step ?
                                <select
                                    name="luggages"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm pr-8"
                                    onChange={handleChange}
                                    value={inputs.luggages}
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
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.luggages}
                                </span>
                            }
                        </div>
                        <div></div>
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['firstname']}</label>
                            {!inputs.step ?
                                <input
                                    type="text"
                                    name="name"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                    onChange={handleChange}
                                    value={inputs.name}
                                />
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.name}
                                </span>
                            }
                        </div>
                        <div>
                            <label className="mb-3 block text-sm font-medium text-gray-700">{trans['mobile']}</label>
                            {!inputs.step ?
                                <input
                                    type="tel"
                                    name="phone"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                    onChange={handleChange}
                                    value={inputs.phone}
                                    placeholder="+33"
                                />
                            :
                                <span className="block w-full appearance-none text-gray-900 sm:text-sm">
                                    {checkout.phone}
                                </span>
                            }
                        </div>
                        {!inputs.step ?
                            <div className="col-span-full">
                                <label className="mb-3 block text-sm font-medium text-gray-700">{trans['voucher']}</label>
                                <input
                                    type="text"
                                    name="voucher"
                                    className="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm"
                                    onChange={handleChange}
                                    value={inputs.voucher}
                                />
                            </div>
                        :
                            <></>
                        }
                        <div className="col-span-full">
                            <dl className="mt-10 text-sm font-medium text-gray-500 space-y-6">
                                {price ?
                                    <div className="flex justify-between">
                                        <dt>Sous-total</dt>
                                        <dd className="text-gray-900">{price}</dd>
                                    </div>
                                :
                                    <></>
                                }
                                {checkout.voucher && inputs.step === 1 ?
                                    <div className="flex justify-between">
                                        <dt className="flex">Code promo<span className="ml-2 rounded-full bg-gray-200 px-2 py-0.5 text-xs tracking-wide text-gray-600">{checkout.voucher.code}</span></dt>
                                        <dd className="text-gray-900">-{checkout.voucher.format}</dd>
                                    </div>
                                :
                                    <></>
                                }
                                {price || checkout.format ?
                                    <div className="flex items-center justify-between border-t border-gray-200 pt-6 text-gray-900">
                                        <dt>Total</dt>
                                        {checkout ?
                                            <dd>{checkout.format}</dd>
                                        :
                                            <dd>{price}</dd>
                                        }
                                    </div>
                                :
                                    <></>
                                }
                            </dl>
                        </div>
                        <div className="col-span-full">
                            {!inputs.step ?
                                <button
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full"
                                    type="submit"
                                    variant="solid"
                                    color="blue"
                                >{trans['next']}</button>
                            :
                                <button
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full"
                                    type="submit"
                                    variant="solid"
                                    color="blue"
                                >{trans['confirm.my.booking']}</button>
                            }
                        </div>
                        <div className="col-span-full">
                            {!inputs.step ?
                                <a
                                    href="/"
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 active:text-slate-600 focus-visible:outline-white w-full"
                                    variant="solid"
                                    color="white"
                                >{trans['cancel']}</a>
                            :
                                <a
                                    href=""
                                    className="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 active:text-slate-600 focus-visible:outline-white w-full"
                                    variant="solid"
                                    color="white"
                                    onClick={handleCancel}
                                >{trans['back']}</a>
                            }
                        </div>
                    </form>
                </>
            }
        </>
    )
}

function clasify(){
	var zoning=[
		{
			'zid':2,
			'value':'Commercial',
			//'color':'#E1A611',
			'color':'#229785',
			'usage':
			[
				{
					'usage':0,
					'value':'Retail',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Food & Drink',
							'refine':
							[
								{
									'refine':0,
									'value':'butcher'
								},
								{
									'refine':1,
									'value':'bakery'
								},
								{
									'refine':2,
									'value':'Fishmonger'
								},
								{
									'refine':3,
									'value':'Specialist'
								},
								{
									'refine':4,
									'value':'Off License'
								},
								{
									'refine':5,
									'value':'Sweets'
								}									
							]
						},
						{
							'subusage':1,
							'value':'Bicycles',
							'refine':
							[
								{
									'refine':0,
									'value':'Sales'
								},
								{
									'refine':1,
									'value':'Repair'
								},
								{
									'refine':2,
									'value':'Sales & Repair'
								}
							]
						},
						{
							'subusage':3,
							'value':'Clothing and Fashion',
							'refine':
							[
								{
									'refine':0,
									'value':'Shoes'
								},
								{
									'refine':1,
									'value':'Clothes'
								},
								{
									'refine':2,
									'value':'Bags and Accessories'
								},
								{
									'refine':3,
									'value':'Women\'s Fashion'
								},
								{
									'refine':4,
									'value':'Men\'s Fashion'
								},
								{
									'refine':4,
									'value':'Children\'s and Maternity'
								},
								{
									'refine':5,
									'value':'Hire'
								}
									
					
							]
							
						},
						{
							'subusage':4,
							'value':'Stationary, Supplies and Books',
							'refine':
							[
								{
									'refine':0,
									'value':'Books'
								},
								{
									'refine':1,
									'value':'Newsstand'
								},
								{
									'refine':2,
									'value':'Arts, Crafts and Hobbies'
								},
								{
									'refine':3,
									'value':'Hobbies'
								},
								{
									'refine':4,
									'value':'Office Supplies'
								}
							]
						},
						{
							'subusage':6,
							'value':'Health and Beauty',
							'refine':
							[
								{
									'refine':0,
									'value':'Pharmacy'
								},
								{
									'refine':1,
									'value':'Medical and Orthopedic'
								},
								{
									'refine':2,
									'value':'Cosmetics and Toiletries'
								}
							]
						},
						{
							'subusage':7,
							'value':'Department Store',
							'refine':
							[
								{
									'refine':0,
									'value':'Catalogue'
								},
								{
									'refine':1,
									'value':'Grocery Included'
								},
								{
									'refine':2,
									'value':'General Wares and Clothing'
								},
								{
									'refine':3,
									'value':'Luxury Goods'
								}
							]
						},
						{
							'subusage':8,
							'value':'Supermarket'
						},
						{
							'subusage':9,
							'value':'Sport',
							'refine':
								[
									{
										'refine':0,
										'value':'Equipment'
									}
								]
						},
						{
							'subusage':10,
							'value':'House and Garden',
							'refine':
							[
								{
									'refine':0,
									'value':'Furniture and Lighting'
								},
								{
									'refine':1,
									'value':'tools'
								},
								{
									'refine':2,
									'value':'Plants and Garden'
								},
								{
									'refine':3,
									'value':'Floor and Wall coverings'
								},
								{
									'refine':4,
									'value':'General Supplies'
								},
								{
									'refine':5,
									'value':'appliances'
								}
							]
						},
						{
							'subusage':11,
							'value':'Convenience Store'
						},
						{
							'subusage':12,
							'value':'Second Hand',
							'refine':
							[
								{
									'refine':0,
									'value':'Charity Shop'
								},
								{
									'refine':1,
									'value':'Pawn Shop'
								}
							]
						},
						{
							'subusage':13,
							'value':'Electronic and Cameras',
							'refine':
							[
								{
									'refine':0,
									'value':'Cameras'
								},
								{
									'refine':1,
									'value':'Information Technology'
								},
								{
									'refine':2,
									'value':'Sound & Vision'
								},
								{
									'refine':3,
									'value':'Mobile Phones'
								}
							]
						},
						{
							'subusage':14,
							'value':'Music',
							'refine':
							[
								{
									'refine':0,
									'value':'Instruments'
								},
								{
									'refine':1,
									'value':'Sheet Music'
								},
								{
									'refine':2,
									'value':'Recordings'
								}
							]
						},
						{
							'subusage':15,
							'value':'Specialist',
							'refine':
							[
								{
									'refine':0,
									'value':'Antiques'
								},
								{
									'refine':1,
									'value':'Jewellers'
								},
								{
									'refine':2,
									'value':'textiles'
								},
								{
									'refine':3,
									'value':'Toys and Games'
								}
							]
						},
						{
							'subusage':16,
							'value':'Motor Vehicles',
							'refine':
							[
								{
									'refine':0,
									'value':'Car Sales'
								},
								{
									'refine':1,
									'value':'Motorbike Sales'
								},
								{
									'refine':2,
									'value':'Parts'
								}
							]
						},
						{
							'subusage':17,
							'value':'Wholesale',
							'refine':
							[
								{
									'refine':0,
									'value':'Fruit and Vegetables'
								},
								{
									'refine':1,
									'value':'Electrical Appliances'
								},
								{
									'refine':2,
									'value':'Household Goods'
								},
								{
									'refine':3,
									'value':'Building Merchants'
								},
								{
									'refine':4,
									'value':'Equipment Hire'
								}
							]
						}
					]
				},

				{
					'usage':2,
					'value':'Hospitality',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Accomodation',
							'refine':
							[
								{
									'refine':0,
									'value':'Hotel'
								},
								{
									'refine':1,
									'value':'Short Stay'
								},
								{
									'refine':2,
									'value':'B&B and other'
								}
							]
						},
						{
							'subusage':1,
							'value':'Food,Entertainment and drink',
							'refine':
							[
								{
									'refine':0,
									'value':'Pub'
								},
								{
									'refine':1,
									'value':'Restaurant'
								},
								{
									'refine':2,
									'value':'Coffee Shop'
								},
								{
									'refine':3,
									'value':'Nightclub'
								},
								{
									'refine':4,
									'value':'Take Away'
								},
								{
									'refine':5,
									'value':'Cafe'
								},
								{
									'refine':6,
									'value':'Gastro Pub'
								}
							]
						},
						{
							'subusage':2,
							'value':'Tourism'
						},
						{
							'subusage':3,
							'value':'Entertainment'
						}
					]			
				},
				{
					'usage':3,
					'value':'Service',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Cleaning',
							'refine':
							[
								{
									'refine':0,
									'value':"Dry Cleaning"
								}
							]
						},
						{
							'subusage':1,
							'value':'Hair',
							'refine':
							[
								{
									'refine':0,
									'value':"Women's"
								},
								{
									'refine':1,
									'value':'Barber'
								},
								{
									'refine':2,
									'value':'Unisex'
								}
							]
						},
						{
							'subusage':2,
							'value':'Pets'
						},
						{
							'subusage':3,
							'value':'Professional',
							'refine':
							[
								{
									'refine':0,
									'value':"Business Consultancy"
								},
								{
									'refine':1,
									'value':'Architects'
								},
								{
									'refine':2,
									'value':'Solicitors'
								},
								{
									'refine':3,
									'value':'Wired Telecommunications'
								},
								{
									'refine':4,
									'value':'Other Telecommunications'
								},
								{
									'refine':5,
									'value':'Computer Programming'
								},
								{
									'refine':6,
									'value':'Other IT and computer'
								},
								{
									'refine':7,
									'value':'Accountants'
								},
								{
									'refine':8,
									'value':'Engineers'
								},
								{
									'refine':9,
									'value':'Advertising'
								},
								{
									'refine':10,
									'value':'Specialist Design'
								},
								{
									'refine':11,
									'value':'Photographer'
								},
								{
									'refine':12,
									'value':'Other'
								},
								{
									'refine':13,
									'value':'Employment Agency'
								}
							]
						},
						{
							'subusage':4,
							'value':'Travel',
							'refine':
							[
								{
									'refine':0,
									'value':"Travel Agency"
								},
								{
									'refine':1,
									'value':'Tour Operator'
								}
							]
						},
						{
							'subusage':5,
							'value':'Personal',
							'refine':
							[
								{
									'refine':0,
									'value':"Physical Wellbeing"
								},
								{
									'refine':1,
									'value':'O'
								}
							]
						},
						{
							'subusage':6,
							'value':'Undertakers'
						},
						{
							'subusage':7,
							'value':'Bookmakers'
						},
						{
							'subusage':8,
							'value':'Florist'
						},
						{
							'subusage':9,
							'value':'Financial Services',
							'refine':
								[
									{
										'refine':0,
										'value':'Bank'
									},
									{
										'refine':1,
										'value':'Credit Union'
									},
									{
										'refine':2,
										'value':'Insurance and Pension'
									},
									{
										'refine':3,
										'value':'Security and Commodity'
									},
									{
										'refine':4,
										'value':'Support Services'
									},
									{
										'refine':5,
										'value':'Risk and Damage Evaluation'
									}
								]
						},
						{
							'subusage':10,
							'value':'Property Services',
							'refine':
								[
									{
										'refine':0,
										'value':'Real Estate Agents'
									},
									{
										'refine':1,
										'value':'Renting and Operating'
									},
									{
										'refine':2,
										'value':'Real Estate Activities'
									},
									{
										'refine':3,
										'value':'Management'
									},
									{
										'refine':4,
										'value':'Security Systems'
									},
									{
										'refine':5,
										'value':'Building Cleaning'
									}
								]
						},
						{
							'subusage':11,
							'value':'Publishing',
							'refine':
								[
									{
										'refine':0,
										'value':'General'
									},
									{
										'refine':1,
										'value':'Newspapers'
									},
									{
										'refine':2,
										'value':'Radio Broadcasting'
									}
								]
						},
						{
							'subusage':12,
							'value':'Bookings and Reservations'
						},
						{
							'subusage':13,
							'value':'Other',
							'refine':
								[
									{
										'refine':0,
										'value':'Office and Business Support'
									},
									{
										'refine':1,
										'value':'Convention Orginisation'
									}
								]
						}
					]			
				},
				{
					'usage':4,
					'value':'Transport',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Parking'
						},
						{
							'subusage':1,
							'value':'Filling Station'
						},
						{
							'subusage':2,
							'value':'Taxi, Bus and Hackney'
						},
						{
							'subusage':3,
							'value':'Water Transport'
						},
						{
							'subusage':4,
							'value':'Air Transport'
						},
						{
							'subusage':5,
							'value':'Land Transport'
						},
						{
							'subusage':6,
							'value':'Transport support services'
						},
						{
							'subusage':7,
							'value':'Renting and Leasing',
							'refine':
							[
								{
									'refine':0,
									'value':'Motor Vehicles'
								},{
									'refine':1,
									'value':'Air Transport Equipment'
								}
							]
						}						
					]			
				}
			]
		},
		{
			'zid':3,
			'value':'Residential',
			//'color':'#75806D',
			'color':'#60D0E2',
			'usage':
			[
				{
					'usage':0,
					'value':'Private'
				},
				{
					'usage':1,
					'value':'Institutional'
				},
				{
					'usage':2,
					'value':'Dormitory','subusage':
					[
						{
							'subusage':0,
							'value':'School'
						},
						{
							'subusage':1,
							'value':'Refugees'
						}
					]
				}
			]
		},
		{
			'zid':5,
			'value':'Industrial',
			//'color':'#274B55',
			'color':'#9D399D',
			'usage':
			[
				{
					'usage':0,
					'value':'Heavy',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Infrastructure',
							'refine':
							[
								{
									'refine':0,
									'value':'Electricity'
								}
							]
						},
						{
							'subusage':1,
							'value':'Waste Services',
							'refine':
							[
								{
									'refine':0,
									'value':'Non Hazourdous'
								},
								{
									'refine':1,
									'value':'Recycling'
								},
								{
									'refine':2,
									'value':'Remediation'
								}
							]
						},
						{
							'subusage':2,
							'value':'Buildings',
							'refine':
							[
								{
									'refine':0,
									'value':'Construction'
								},
								{
									'refine':1,
									'value':'Development'
								}
							]
						},
						{
							'subusage':3,
							'value':'Trades',
							'refine':
							[
								{
									'refine':0,
									'value':'Electrical'
								},
								{
									'refine':1,
									'value':'Painting and Glazing'
								}
							]
						}
					]
				},
				{
					'usage':1,
					'value':'Light',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Maintenance and Repair',
							'refine':
							[
								{
									'refine':0,
									'value':'Cars'
								},
								{
									'refine':1,
									'value':'Appliances'
								},
								{
									'refine':2,
									'value':'Motorbikes'
								},
								{
									'refine':3,
									'value':'Computers and Peripherals'
								},
								{
									'refine':4,
									'value':'Footwear and Leather Goods'
								},
								{
									'refine':5,
									'value':'Furniture'
								},
								{
									'refine':6,
									'value':'Other personal and household'
								}
									
							]
						},{
							'subusage':1,
							'value':'Manufacture',
							'refine':
							[
								{
									'refine':0,
									'value':'Baked Goods'
								},
								{
									'refine':1,
									'value':'Textiles'
								},
								{
									'refine':2,
									'value':'Paper Products'
								},
								{
									'refine':3,
									'value':'Pharmaceutical'
								},
								{
									'refine':4,
									'value':'Metal Raw'
								},
								{
									'refine':5,
									'value':'Metal Products'
								},
								{
									'refine':6,
									'value':'Joinery'
								},
								{
									'refine':7,
									'value':'Jewellery and fine goods'
								},
								{
									'refine':8,
									'value':'Other'
								}
									
							]
						},{
							'subusage':2,
							'value':'Services',
							'refine':
							[
								{
									'refine':0,
									'value':'Printing'
								},
								{
									'refine':1,
									'value':'Stonework'
								}
									
							]
						}

					]
				}
			]
		},
		{
			'zid':12,
			'value':'Civic',
			//'color':'#6146FB',
			'color':'#F2FF1A',
			'usage':
			[
				{
					'usage':0,
					'value':'Religious'
				},
				{
					'usage':1,
					'value':'State'
				},
				{
					'usage':2,
					'value':'Social',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Social Services'
						},
						{
							'subusage':1,
							'value':'Elderly and Disabled'
						},
						{
							'subusage':2,
							'value':'Child Day Care'
						}
					]
				},
				{
					'usage':3,
					'value':'Educational',
					'subusage':
					[
						{
							'subusage':0,
							'value':'school',
							'refine':
							[
								{
									'refine':0,
									'value':'Primary'
								},
								{
									'refine':1,
									'value':'Secondary'
								},
								{
									'refine':2,
									'value':'Pre-Primary'
								}
							]
						},
						{
							'subusage':1,
							'value':'College'
						},
						{
							'subusage':2,
							'value':'Driving School'
						},
						{
							'subusage':3,
							'value':'Other Education'
						},
						{
							'subusage':4,
							'value':'Cultural'
						}
					]
				},
				{
					'usage':4,
					'value':'Transport',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Rail'
						}
					]
				},
				{
					'usage':5,
					'value':'Healthcare',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Hospital'
						},						
						{
							'subusage':1,
							'value':'General Practioners',
							'refine':
							[
								{
									'refine':0,
									'value':'Doctor'
								},
								{
									'refine':1,
									'value':'Dentist'
								}
							]
						},
						{
							'subusage':2,
							'value':'Residential Care'
						},
						{
							'subusage':3,
							'value':'Specialists'
						},
						{
							'subusage':4,
							'value':'Other'
						}
					]
				},
				{
					'usage':6,
					'value':'Arts and Culture',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Gallery'
						},
						{
							'subusage':1,
							'value':'Museum'
						},
						{
							'subusage':2,
							'value':'Performing Arts'
						},
						{
							'subusage':3,
							'value':'Cinema'
						},
						{
							'subusage':4,
							'value':'Administrations'
						},
						{
							'subusage':5,
							'value':'Artistic Creation'
						},
						{
							'subusage':6,
							'value':'Historical'
						}
					]
				},
				{
					'usage':7,
					'value':'Sport',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Sports Facility'
						},
						{
							'subusage':1,
							'value':'Sports Club'
						},
						{
							'subusage':2,
							'value':'Fitness Facility'
						}
					]
				},
				{
					'usage':8,
					'value':'political',
					'subusage':
					[
						{
							'subusage':0,
							'value':'Political Organisation'
						},
						{
							'subusage':1,
							'value':'Trade Union'
						},
						{
							'subusage':2,
							'value':'Other Membership Organisations'
						}
					]
				}
			]
		}
	]
return zoning;
}	

<?php

if($nace[0]=='C'){
	$return->zid=5; //**
	$return->usage=1; //**
	if($nace[1]==10){
		$return->subusage=1; //**
	
		//C.10.71 | MANUFACTURE OF BREAD; MANUFACTURE OF FRESH PASTRY GOODS AND CAKES

		if($nace[2]==71){
			$return->refine=0; //**
		}
	}
	if($nace[1]==13){
		$return->subusage=1; //**
	
		//C.13.92 | MANUFACTURE OF MADE-UP TEXTILE ARTICLES, EXCEPT APPAREL

		if($nace[2]==92){
			$return->refine=1; //**
		}
	}
	if($nace[1]==17){
		$return->subusage=1; //**
	
		//C.17.12 | MANUFACTURE OF PAPER AND PAPERBOARD

		if($nace[2]==12){
			$return->refine=2; //**
		}
	}
	if($nace[1]==18){
		$return->subusage=2; //**
	
		//C.18.10 | PRINTING AND SERVICE ACTIVITIES RELATED TO PRINTING

		if($nace[2]==10){
			$return->refine=0; //**
		}
	}
	if($nace[1]==21){
		$return->subusage=1; //**
	
		//C.21.10 | MANUFACTURE OF BASIC PHARMACEUTICAL PRDOUCTS

		if($nace[2]==10){
			$return->refine=3; //**
		}
	}
	if($nace[1]==23){
		$return->subusage=2; //**
	
		//C.23.70 | CUTTING, SHAPING AND FINISHING OF STONE

		if($nace[2]==70){
			$return->refine=1; //**
		}
	}
	if($nace[1]==24){
		$return->subusage=1; //**
	
		//C.24.10 | MANUFACTURE OF BASIC IRON AND STEEL AND OF FERRO-ALLOYS

		if($nace[2]==10){
			$return->refine=4; //**
		}
	}
	if($nace[1]==25){
		$return->subusage=1; //**
	
		//C.25.00 | MANUFACTURE OF FABRICATED METAL PRODUCTS, EXCEPT MACHINERY AND EQUIPMENT

		if($nace[2]==0){
			$return->refine=5; //**
		}
	}
	if($nace[1]==31){
		$return->subusage=1; //**
	
		//C.31.02 | MANUFACTURE OF KITCHEN FURNITURE

		if($nace[2]==2){
			$return->refine=6; //**
		}
	}
	if($nace[1]==32){
		$return->subusage=1; //**
	
		//C.32.12 | MANUFACTURE OF JEWELLERY AND RELATED ARTICLES

		if($nace[2]==12){
			$return->refine=7; //**
		}

		//C.32.99 | OTHER MANUFACTURING N.E.C.

		if($nace[2]==99){
			$return->refine=8; //**
		}
	}
}
if($nace[0]=='D'){
	$return->zid=5; //**
	$return->usage=0; //**
	if($nace[1]==35){
		$return->subusage=0; //**
	
		//D.35.10 | ELECTRIC POWER GENERATION, TRANSMISSION AND DISTRIBUTION

		if($nace[2]==10){
			$return->refine=0; //**
		}
	}
}
if($nace[0]=='E'){
	$return->zid=5; //**
	$return->usage=0; //**
	if($nace[1]==38){
		$return->subusage=1; //**
	
		//E.38.21 | TREATMENT AND DISPOSAL OF NON-HAZARDOUS WASTE

		if($nace[2]==21){
			$return->refine=0; //**
		}

		//E.38.32 | RECOVERY OF SORTED MATERIALS

		if($nace[2]==32){
			$return->refine=1; //**
		}
	}
	if($nace[1]==39){
		$return->subusage=null; //**
	
		//E.39.00 | REMEDIATION ACTIVITIES AND OTHER WASTE MANAGEMENT SERVICES

		if($nace[2]==0){
			$return->refine=2; //**
		}
	}
}
if($nace[0]=='F'){
	$return->zid=5; //**
	$return->usage=0; //**
	if($nace[1]==41){
		$return->subusage=2; //**
	
		//F.41.00 | CONSTRUCTION OF BUILDINGS

		if($nace[2]==0){
			$return->refine=0; //**
		}

		//F.41.10 | DEVELOPMENT OF BUILDING PROJECTS

		if($nace[2]==10){
			$return->refine=1; //**
		}

		//F.41.20 | CONSTRUCTION OF RESIDENTIAL AND NON-RESIDENTIAL BUILDINGS

		if($nace[2]==20){
			$return->refine=0; //**
		}
	}
	if($nace[1]==43){
		$return->subusage=3; //**
	
		//F.43.21 | ELECTRICAL INSTALLATION

		if($nace[2]==21){
			$return->refine=0; //**
		}

		//F.43.34 | PAINTING AND GLAZING

		if($nace[2]==34){
			$return->refine=1; //**
		}
	}
}
if($nace[0]=='G'){
	$return->zid=2; //**
	$return->usage=0; //**
	if($nace[1]==45){
		$return->subusage=16; //**
	
		//G.45.10 | SALE OF MOTOR VEHICLES

		if($nace[2]==10){
			$return->refine=0; //**
		}

		//G.45.20 | MAINTENANCE AND REPAIR OF MOTOR VEHICLES

		if($nace[2]==20){
			$return->zid=5;
			$return->usage=1;
			$return->subusage=0;
			$return->refine=0; //**
		}

		//G.45.30 | SALE OF MOTOR VEHICLE PARTS AND ACCESSORIES

		if($nace[2]==30){
			$return->refine=2; //**
		}

		//G.45.40 | SALE, MAINTENANCE AND REPAIR OF MOTORCLCLES AND RELATED PARTS AND ACCESSORIES

		if($nace[2]==40){
			$return->zid=5;
			$return->usage=1;
			$return->subusage=0;
			$return->refine=2; //**
		}
	}
	if($nace[1]==46){
		$return->subusage=17; //**
	
		//G.46.31 | WHOLESALE OF FRUIT AND VEGETABLES

		if($nace[2]==31){
			$return->refine=0; //**
		}

		//G.46.43 | WHOLESALE OF ELECTRICAL HOUSEHOLD APPLIANCES

		if($nace[2]==43){
			$return->refine=1; //**
		}

		//G.46.49 | WHOLESALE OF OTHER HOUSEHOLD GOODS

		if($nace[2]==49){
			$return->refine=2; //**
		}

		//G.46.73 | WHOLESALE OF WOOD, CONSTRUCTION MATERIALS AND SANITARY EQUIPMENT

		if($nace[2]==73){
			$return->refine=3; //**
		}
	}
	if($nace[1]==47){
		$return->subusage=null; //**
	
		//G.47.11 | RETAIL SALE IN NON-SPECIALIZED STORES WITH FOOD, BEVERAGES OR TOBACCO PREDOMINATING

		if($nace[2]==11){
			$return->subusage=11;
			$return->refine=null; //**
		}

		//G.47.19 | OTHER RETAIL SALE IN NON-SPECIALISED STORES

		if($nace[2]==19){
			$return->subusage=8;
			$return->refine=null; //**
		}

		//G.47.20 | RETAIL SALE OF FOOD, BEVERAGES AND TOBACCO IN SPECIALISED STORES
		
		if($nace[2]==20){
			$return->subusage=11;
			$return->refine=null; //**
		}

		//G.47.22 | RETAIL SALE OF MEAT AND MEAT PRODUCTS IN SPECIALISED STORES

		if($nace[2]==22){
			$return->subusage=0;
			$return->refine=0; //**
		}

		//G.47.23 | RETAIL SALE OF FISH, CRUSTACEANS AND MOLLUSCS IN SPECIALISED STORES

		if($nace[2]==23){
			$return->subusage=0;
			$return->refine=2; //**
		}

		//G.47.24 | RETAIL SALE OF BREAD, CAKES, FLOUR CONFECTIONERY AND SUGAR CONFECTIONERY IN SPECIALISED STORES

		if($nace[2]==24){
			$return->subusage=0;
			$return->refine=1; //**
		}

		//G.47.25 | RETAIL SALE OF BEVERAGES IN SPECIALISED STORES

		if($nace[2]==25){
			$return->subusage=0;
			$return->refine=4; //**
		}

		//G.47.29 | OTHER RETAIL SALE OF FOOD IN SPECIALISED STORES

		if($nace[2]==29){
			$return->subusage=0;
			$return->refine=3; //**
		}

		//G.47.41 | RETAIL SALE OF COMPUTERS, PERIPHERAL UNITS AND SOFTWARE IN SPECIALISED STORES

		if($nace[2]==41){
			$return->subusage=13;
			$return->refine=1; //**
		}

		//G.47.42 | RETAIL SALE OF TELECOMMUNICATIONS EQUIPMENT IN SPECIALISED STORES

		if($nace[2]==42){
			$return->subusage=13;
			$return->refine=3; //**
		}

		//G.47.43 | RETAIL SALE OF AUDIO AND VIDEO EQUIPMENT IN SPECIALISED STORES

		if($nace[2]==43){
			$return->subusage=13;
			$return->refine=2; //**
		}

		//G.47.51 | RETAIL SALE OF TEXTILES IN SPECIALISED STORES

		if($nace[2]==51){
			$return->subusage=15;
			$return->refine=2; //**
		}

		//G.47.52 | RETAIL SALE OF HARDWARE, PAINTS AND GLASS IN SPECIALISED STORES

		if($nace[2]==52){
			$return->subusage=10;
			$return->refine=4; //**
		}

		//G.47.53 | RETAIL SALE OF CARPETS, RUGS, WALL AND FLOOR COVERINGS IN SPECIALISED STORES

		if($nace[2]==53){
			$return->subusage=10;
			$return->refine=3; //**
		}

		//G.47.54 | RETAIL SALE OF ELECTRICAL HOUSEHOLD APPLIANCES IN SPECIALISED STORES

		if($nace[2]==54){
			$return->subusage=10;
			$return->refine=5; //**
		}

		//G.47.59 | RETAIL SALE OF FURNITURE, LIGHTING EQUIPMENT AND OTHER HOUSEHOLD ARTICLES IN SPECIALISED STORES

		if($nace[2]==59){
			$return->subusage=10;
			$return->refine=0; //**
		}

		//G.47.61 | RETAIL SALE OF BOOKS IN SPECIALISED STORES

		if($nace[2]==61){
			$return->subusage=4;
			$return->refine=0; //**
		}

		//G.47.62 | RETAIL SALE OF NEWSPAPERS AND STATIONERY IN SPECIALISED STORES

		if($nace[2]==62){
			$return->subusage=4;
			$return->refine=1; //**
		}

		//G.47.64 | RETAIL SALE OF SPORTING EQUIPMENT IN SPECIALISED STORES

		if($nace[2]==64){
			$return->subusage=9;
			$return->refine=0; //**
		}

		//G.47.65 | RETAIL SALE OF GAMES AND TOYS IN SPECIALISED STORES

		if($nace[2]==65){
			$return->subusage=15;
			$return->refine=3; //**
		}

		//G.47.70 | RETAIL SALE OF OTHER GOODS IN SPECIALISED STORES

		if($nace[2]==70){
			$return->subusage=15;
			$return->refine=null; //**
		}

		//G.47.71 | RETAIL SALE OF CLOTHING IN SPECIALISED STORES

		if($nace[2]==71){
			$return->subusage=3;
			$return->refine=null; //**
		}

		//G.47.72 | RETAIL SALE OF FOOTWEAR AND LEATHER GOODS IN SPECIALISED STORES

		if($nace[2]==72){
			$return->subusage=3;
			$return->refine=0; //**
		}

		//G.47.73 | DISPENSING CHEMIST IN SPECIALISED STORES

		if($nace[2]==73){
			$return->subusage=6;
			$return->refine=0; //**
		}

		//G.47.74 | RETAIL SALE OF MEDICAL AND ORTHOPAEDIC GOODS IN SPECIALISED STORES

		if($nace[2]==74){
			$return->subusage=6;
			$return->refine=1; //**
		}

		//G.47.75 | RETAIL SALE OF COSMETIC AND TOILET ARTICLES IN SPECIALISED STORES

		if($nace[2]==75){
			$return->subusage=6;
			$return->refine=2; //**
		}

		//G.47.76 | RETAIL SALE OF FLOWERS, PLANTS, SEEDS, FERTILISERS, PET ANIMALS AND PET FOOD IN SPECIALISED STORES

		if($nace[2]==76){
			$return->subusage=10;
			$return->refine=null; //**
		}

		//G.47.77 | RETAIL SALE OF WATCHES AND JEWELLERY IN SPECIALISED STORES

		if($nace[2]==77){
			$return->subusage=15;
			$return->refine=1; //**
		}

		//G.47.78 | OTHER RETAIL SALE OF NEW GOODS IN SPECIALISED STORES

		if($nace[2]==78){
			$return->subusage=15;
			$return->refine=null; //**
		}

		//G.47.79 | RETAIL SALE OF SECOND-HAND GOODS IN STORES

		if($nace[2]==79){
			$return->subusage=12;
			$return->refine=null; //**
		}
	}
}
if($nace[0]=='H'){
	$return->zid=2; //**
	$return->usage=4; //**
	if($nace[1]==49){
		$return->subusage=2; //**
	
		//H.49.32 | TAXI OPERATION

		if($nace[2]==32){
			$return->refine=null; //**
		}

		//H.49.39 | OTHER PASSENGER LAND TRANSPORT N.E.C.

		if($nace[2]==39){
			$return->refine=null; //**
		}
	}
	if($nace[1]==50){
		$return->subusage=3; //**
	
		//H.50.10 | SEA AND COASTAL PASSENGER WATER TRANSPORT

		if($nace[2]==10){
			$return->refine=null; //**
		}
	}
	if($nace[1]==51){
		$return->subusage=4; //**
	
		//H.51.21 | FREIGHT AIR TRANSPORT

		if($nace[2]==21){
			$return->refine=null; //**
		}
	}
	if($nace[1]==52){
		$return->subusage=6; //**
	
		//H.52.21 | SERVICE ACTIVITIES INCIDENTAL TO LAND TRANSPORTATION

		if($nace[2]==21){
			$return->refine=null; //**
		}

		//H.52.29 | OTHER TRANSPORTATION SUPPORT ACTIVITIES

		if($nace[2]==29){
			$return->refine=null; //**
		}
	}
}
if($nace[0]=='I'){
	$return->zid=2; //**
	$return->usage=2; //**
	if($nace[1]==55){
		$return->subusage=0; //**
	
		//I.55.10 | HOTELS AND SIMILAR ACCOMMODATION

		if($nace[2]==10){
			$return->refine=0; //**
		}

		//I.55.20 | HOLIDAY AND OTHER SHORT-STAY ACCOMMODATION

		if($nace[2]==20){
			$return->refine=1; //**
		}

		//I.55.90 | OTHER ACCOMMODATION

		if($nace[2]==90){
			$return->refine=2; //**
		}
	}
	if($nace[1]==56){
		$return->subusage=1; //**
	
		//I.56.10 | RESTAURANTS AND MOBILE FOOD SERVICE ACTIVITIES

		if($nace[2]==10){
			$return->refine=1; //**
		}

		//I.56.30 | BEVERAGE SERVING ACTIVITIES

		if($nace[2]==30){
			$return->refine=0; //**
		}
	}
}
if($nace[0]=='J'){
	$return->zid=2; //**
	$return->usage=3; //**
	if($nace[1]==58){
		$return->subusage=11; //**
	
		//J.58.10 | PUBLISHING OF BOOKS, PERIODICALS AND OTHER PUBLISHING ACTIVITIES

		if($nace[2]==10){
			$return->refine=0; //**
		}

		//J.58.13 | PUBLISHING OF NEWSPAPERS

		if($nace[2]==13){
			$return->refine=1; //**
		}
	}
	if($nace[1]==60){
		$return->subusage=11; //**
	
		//J.60.10 | RADIO BROADCASTING

		if($nace[2]==10){
			$return->refine=2; //**
		}
	}
	if($nace[1]==61){
		$return->subusage=3; //**
	
		//J.61.10 | WIRED TELECOMMUNICATIONS ACTIVITIES

		if($nace[2]==10){
			$return->refine=3; //**
		}

		//J.61.90 | OTHER TELLECOMMUNICATIONS ACTIVITIES

		if($nace[2]==90){
			$return->refine=4; //**
		}
	}
	if($nace[1]==62){
		$return->subusage=3; //**
	
		//J.62.01 | COMPUTER PROGRAMMING ACTIVITIES

		if($nace[2]==1){
			$return->refine=5; //**
		}

		//J.62.09 | OTHER INFORMATION TECHNOLOGY AND COMPUTER RELATED ACTIVITIES

		if($nace[2]==9){
			$return->refine=6; //**
		}
	}
}
if($nace[0]=='K'){
	$return->zid=2; //**
	$return->usage=3; //**
	if($nace[1]==64){
		$return->subusage=9; //**
	
		//K.64.19 | OTHER MONERTARY INTERMEDIATION

		if($nace[2]==19){
			$return->refine=0; //**
		}

		//K.64.92 | OTHER CREDIT GRANTING

		if($nace[2]==92){
			$return->refine=1; //**
		}
	}
	if($nace[1]==65){
		$return->subusage=9; //**
	
		//K.65.00 | INSURANCE,REINSURANCE AND PENSION FUNDING, EXCEPT COMPULSORY SOCIAL SECURITY

		if($nace[2]==0){
			$return->refine=2; //**
		}

		//K.65.11 | LIFE INSURANCE

		if($nace[2]==11){
			$return->refine=2; //**
		}

		//K.65.30 | PENSION FUNDING

		if($nace[2]==30){
			$return->refine=2; //**
		}
	}
	if($nace[1]==66){
		$return->subusage=9; //**
	
		//K.66.12 | SECURITY AND COMMODITY CONTRACTS BROKERAGE

		if($nace[2]==12){
			$return->refine=3; //**
		}

		//K.66.19 | OTHER ACTIVITIES AUXILIARY TO FIANCIAL SERVICES, EXCEPT INSURANCE AND PENSION

		if($nace[2]==19){
			$return->refine=4; //**
		}

		//K.66.21 | RISK AND DAMAGE EVALUATION

		if($nace[2]==21){
			$return->refine=5; //**
		}

		//K.66.22 | ACTIVITIES OF INSURANCE AGENTS AND BROKERS

		if($nace[2]==22){
			$return->refine=4; //**
		}
	}
}
if($nace[0]=='L'){
	$return->zid=2; //**
	$return->usage=3; //**
	if($nace[1]==68){
		$return->subusage=10; //**
	
		//L.68.00 | REAL ESTATE ACTIVITIES

		if($nace[2]==0){
			$return->refine=2; //**
		}

		//L.68.20 | RENTING AND OPERATING OF OWN OR LEASED REAL ESTATE

		if($nace[2]==20){
			$return->refine=1; //**
		}

		//L.68.31 | REAL ESTATE AGENCIES

		if($nace[2]==31){
			$return->refine=0; //**
		}

		//L.68.32 | MANAGEMENT OF REAL ESTATE ON A FEE OR CONTRACT BASIS

		if($nace[2]==32){
			$return->refine=3; //**
		}
	}
}
if($nace[0]=='M'){
	$return->zid=2; //**
	$return->usage=3; //**
	if($nace[1]==69){
		$return->subusage=3; //**
	
		//M.69.10 | LEGAL ACTIVITIES

		if($nace[2]==10){
			$return->refine=2; //**
		}

		//M.69.20 | ACCOUNTING, BOOK-KEEPING AND AUDITING ACTIVITIES; TAX CONSULTANCY

		if($nace[2]==20){
			$return->refine=7; //**
		}
	}
	if($nace[1]==70){
		$return->subusage=3; //**
	
		//M.70.22 | BUSINESS AND OTHER MANAGEMENT CONSULTANCY ACTIVITIES

		if($nace[2]==22){
			$return->refine=0; //**
		}
	}
	if($nace[1]==71){
		$return->subusage=3; //**
	
		//M.71.11 | ARCHITECTURAL ACTIVITIES

		if($nace[2]==11){
			$return->refine=1; //**
		}

		//M.71.12 | ENGINEERING ACTIVITIES AND RELATED TECHNICAL CONSULTANCY

		if($nace[2]==12){
			$return->refine=8; //**
		}
	}
	if($nace[1]==73){
		$return->subusage=3; //**
	
		//M.73.10 | ADVERTISING

		if($nace[2]==10){
			$return->refine=9; //**
		}
	}
	if($nace[1]==74){
		$return->subusage=3; //**
	
		//M.74.10 | SPECIALISED DESIGN ACTIVITIES

		if($nace[2]==10){
			$return->refine=10; //**
		}

		//M.74.20 | PHOTOGRAPHIC ACTIVITIES

		if($nace[2]==20){
			$return->refine=11; //**
		}

		//M.74.90 | OTHER PROFESSIONAL, SCIENTIFIC AND TECHNICAL ACTIVITIES

		if($nace[2]==90){
			$return->refine=12; //**
		}
	}
}
if($nace[0]=='N'){
	$return->zid=2; //**
	$return->usage=3; //**
	if($nace[1]==77){
		$return->subusage=null; //**
	
		//N.77.10 | RENTING AND LEASING OF MOTOR VEHICLES

		if($nace[2]==10){
			$return->usage=4;
			$return->subusage=7;
			$return->refine=0; //**
		}

		//N.77.29 | RENTING AND LEASING OF OTHER PERSONAL AND HOUSEHOLD GOODS

		if($nace[2]==29){
			$return->usage=0;
			$return->subusage=3;
			$return->refine=5; //**
		}

		//N.77.35 | RENTING AND LEASING OF AIR TRANSPORT EQUIPMENT

		if($nace[2]==35){
			$return->usage=4;
			$return->subusage=7;
			$return->refine=4; //**
		}

		//N.77.39 | RENTING AND LEASING OF OTHER MACHINERY, EQUIPMENT AND TANGIBLE GOODS

		if($nace[2]==39){
			$return->usage=0;
			$return->subusage=17;
			$return->refine=4; //**
		}
	}
	if($nace[1]==78){
		$return->usage=3;
		$return->subusage=3; //**
	
		//N.78.10 | ACTIVITIES OF EMPLOYMENT PLACEMENT AGENCIES

		if($nace[2]==13){
			$return->refine=null; //**
		}
	}
	if($nace[1]==79){
		$return->usage=3;
		$return->subusage=null; //**
	
		//N.79.10 | TRAVEL AGENCY AND TOUR OPERATOR ACTIVITIES

		if($nace[2]==10){
			$return->subusage=4;
			$return->refine=0; //**
		}

		//N.79.90 | OTHER RESERVATION SERVICE AND RELATED ACTIVITIES

		if($nace[2]==90){
			$return->subusage=12;
			$return->refine=null; //**
		}
	}
	if($nace[1]==80){
		$return->subusage=10; //**
	
		//N.80.20 | SECURITY SYSTEMS SERVICE ACTIVITIES

		if($nace[2]==20){
			$return->refine=4; //**
		}
	}
	if($nace[1]==81){
		$return->subusage=10; //**
	
		//N.81.21 | GENERAL CLEANING OF BUILDINGS

		if($nace[2]==21){
			$return->refine=5; //**
		}

		//N.81.22 | OTHER BUILDING AND INDUSTRIAL CLEANING ACTIVITIES

		if($nace[2]==22){
			$return->refine=5; //**
		}
	}
	if($nace[1]==82){
		$return->subusage=13; //**
	
		//N.82.10 | OFFICE ADMINISTRATION AND SUPPORT ACTIVITIES

		if($nace[2]==10){
			$return->refine=0; //**
		}

		//N.82.30 | ORGANISATION OF CONVENTIONS AND TRADE SHOWS

		if($nace[2]==30){
			$return->refine=1; //**
		}

		//N.82.99 | OTHER BUSINESS SUPPORT SERVICE ACTIVITIES

		if($nace[2]==99){
			$return->refine=0; //**
		}
	}
}
if($nace[0]=='O'){
	$return->zid=null; //**
	$return->usage=null; //**
	if($nace[1]==84){
		$return->subusage=null; //**
	
		//O.84.00 | PUBLIC ADMINISTRATION AND DEFENCE; COMPULSORY SOCIAL SECURITY

		if($nace[2]==0){
			$return->refine=null; //**
		}

		//O.84.11 | GENERAL PUBLIC ADMINISTRATION ACTIVITIES

		if($nace[2]==11){
			$return->refine=null; //**
		}

		//O.84.22 | DEFENCE ACTIVITIES

		if($nace[2]==22){
			$return->refine=null; //**
		}

		//O.84.23 | JUSTICE AND JUDICIAL ACTIVITIES

		if($nace[2]==23){
			$return->refine=null; //**
		}

		//O.84.25 | FIRE SERVICE ACTIVITIES

		if($nace[2]==25){
			$return->refine=null; //**
		}
	}
}
if($nace[0]=='P'){
	$return->zid=12; //**
	$return->usage=3; //**
	if($nace[1]==85){
		$return->subusage=null; //**
	
		//P.85.00 | EDUCATION

		if($nace[2]==0){
			$return->subusage=1;
			$return->refine=null; //**
		}

		//P.85.10 | PRE-PRIMARY EDUCATION

		if($nace[2]==10){
			$return->subusage=0;
			$return->refine=2; //**
		}

		//P.85.20 | PRIMARY EDUCATION

		if($nace[2]==20){
			$return->subusage=0;
			$return->refine=0; //**
		}

		//P.85.32 | TECHNICAL AND VOCATIONAL SECONDARY EDUCATION

		if($nace[2]==32){
			$return->subusage=1;
			$return->refine=null; //**
		}

		//P.85.42 | TERTIARY EDUCATION

		if($nace[2]==42){
			$return->subusage=1;
			$return->refine=null; //**
		}

		//P.85.52 | CULTURE EDUCATION

		if($nace[2]==52){
			$return->subusage=4;
			$return->refine=null; //**
		}

		//P.85.53 | DRIVING SCHOOL ACTIVITIES

		if($nace[2]==53){
			$return->subusage=2;
			$return->refine=null; //**
		}

		//P.85.59 | OTHER EDUCATION

		if($nace[2]==59){
			$return->subusage=3;
			$return->refine=null; //**
		}
	}
}
if($nace[0]=='Q'){
	$return->zid=12; //**
	$return->usage=5; //**
	if($nace[1]==86){
		$return->subusage=null; //**
	
		//Q.86.21 | GENERAL MEDICAL PRACTICE ACTIVITIES

		if($nace[2]==21){
			$return->subusage=1;
			$return->refine=0; //**
		}

		//Q.86.22 | SPECIALIST MEDICAL PRACTICE ACTIVITIES

		if($nace[2]==22){
			$return->subusage=3;
			$return->refine=null; //**
		}

		//Q.86.23 | DENTAL PRACTICE ACTIVITIES

		if($nace[2]==23){
			$return->subusage=1;
			$return->refine=1; //**
		}

		//Q.86.90 | OTHER HUMAN HEALTH ACTIVITIES

		if($nace[2]==90){
			$return->subusage=4;
			$return->refine=null; //**
		}
	}
	if($nace[1]==87){
		$return->subusage=2; //**
	
		//Q.87.10 | RESIDENTIAL NURSING CARE ACTIVITIES

		if($nace[2]==10){
			$return->refine=null; //**
		}

		//Q.87.90 | OTHER RESIDENTIAL CARE ACTIVITIES

		if($nace[2]==90){
			$return->refine=null; //**
		}
	}
	if($nace[1]==88){
		$return->usage=2;
		$return->subusage=null; //**
	
		//Q.88.00 | SOCIAL WORK ACTIVITIES WITHOUT ACCOMMODATION

		if($nace[2]==0){
			$return->subusage=0;
			$return->refine=null; //**
		}

		//Q.88.10 | SOCIAL WORK ACTIVITIES WITHOUT ACCOMMODATION FOR THE ELDERLY AND DISABLED

		if($nace[2]==10){
			$return->subusage=1;
			$return->refine=null; //**
		}

		//Q.88.91 | CHILD DAY-CARE ACTIVITIES

		if($nace[2]==91){
			$return->subusage=2;
			$return->refine=null; //**
		}

		//Q.88.99 | OTHER SOCIAL WORK ACTIVITIES WITHOUT ACCOMMODATION

		if($nace[2]==99){
			$return->subusage=0;
			$return->refine=null; //**
		}
	}
}
if($nace[0]=='R'){
	$return->zid=12; //**
	$return->usage=6; //**
	if($nace[1]==90){
		$return->subusage=null; //**
	
		//R.90.01 | PERFORMING ARTS

		if($nace[2]==1){
			$return->subusage=2;
			$return->refine=null; //**
		}

		//R.90.03 | ARTISTIC CREATION

		if($nace[2]==3){
			$return->subusage=5;
			$return->refine=null; //**
		}

		//R.90.04 | OPERATION OF ARTS FACILITIES

		if($nace[2]==4){
			$return->subusage=4;
			$return->refine=null; //**
		}
	}
	if($nace[1]==91){
		$return->subusage=null; //**
	
		//R.91.02 | MUSEUMS ACTIVITIES

		if($nace[2]==2){
			$return->subusage=1;
			$return->refine=null; //**
		}

		//R.91.03 | OPERATION OF HISTORICAL SITES AND BUILDINGS AND SIMILAR VISITOR ATTRACTIONS

		if($nace[2]==3){
			$return->subusage=6;
			$return->refine=null; //**
		}
	}
	if($nace[1]==92){
		$return->subusage=null; //**
	
		//R.92.00 | GAMBLING AND BETTING ACTIVITIES

		if($nace[2]==0){
			$return->usage=2;
			$return->subusage=3;
			$return->refine=null; //**
		}
	}
	if($nace[1]==93){
		$return->subusage=null; //**
	
		//R.93.11 | OPERATION OF SPORTS FACILITIES

		if($nace[2]==11){
			$return->usage=7;
			$return->subusage=0;
			$return->refine=null; //**
		}

		//R.93.12 | ACTIVITIES OF SPORT CLUBS

		if($nace[2]==12){
			$return->usage=7;
			$return->subusage=1;
			$return->refine=null; //**
		}

		//R.93.13 | FITNESS FACILITIES

		if($nace[2]==13){
			$return->usage=7;
			$return->subusage=2;
			$return->refine=null; //**
		}

		//R.93.29 | OTHER AMUSEMENT AND RECREATION ACTIVITIES

		if($nace[2]==29){
			$return->usage=2;
			$return->subusage=3;
			$return->refine=null; //**
		}
	}
}
if($nace[0]=='S'){
	$return->zid=12; //**
	$return->usage=null; //**
	if($nace[1]==94){
		$return->subusage=null; //**
	
		//S.94.20 | ACTIVITIES OF TRADE UNIONS

		if($nace[2]==20){
			$return->usage=8;
			$return->subusage=1;
			$return->refine=null; //**
		}

		//S.94.91 | ACTIVITIES OF RELIGIOUS ORGANIZATIONS

		if($nace[2]==91){
			$return->usage=0;
			$return->refine=null; //**
		}

		//S.94.92 | ACTIVITIES OF POLITICAL ORGANIZATIONS

		if($nace[2]==92){
			$return->usage=8;
			$return->subusage=0;
			$return->refine=null; //**
		}

		//S.94.99 | ACTIVITIES OF OTHER MEMBERSHIP ORGANISATIONS

		if($nace[2]==99){
			$return->usage=8;
			$return->subusage=2;
			$return->refine=null; //**
		}
	}
	if($nace[1]==95){
		$return->zid=5;
		$return->usage=1;
		$return->subusage=0; //**
	
		//S.95.11 | REPAIR OF COMPUTERS AND PERIPHERAL EQUIPMENT

		if($nace[2]==11){
			$return->refine=3; //**
		}

		//S.95.23 | REPAIR OF FOOTWEAR AND LEATHER GOODS

		if($nace[2]==23){
			$return->refine=4; //**
		}

		//S.95.24 | REPAIR OF FURNITURE AND HOME FURNISHINGS

		if($nace[2]==24){
			$return->refine=5; //**
		}

		//S.95.29 | REPAIR OF OTHER PERSONAL AND HOUSEHOLD GOODS

		if($nace[2]==29){
			$return->refine=6; //**
		}
	}
	if($nace[1]==96){
		$return->zid=2;
		$return->usage=3;
		$return->subusage=null; //**
	
		//S.96.01 | WASHING AND (DRY-)CLEANING OF TEXTILE AND FUR PRODUCTS

		if($nace[2]==1){
			$return->subusage=0;
			$return->refine=0; //**
		}

		//S.96.02 | HAIRDRESSING AND OTHER BEAUTY TREATMENT

		if($nace[2]==2){
			$return->subusage=1;
			$return->refine=null; //**
		}

		//S.96.03 | FUNERAL AND RELATED ACTIVITIES

		if($nace[2]==3){
			$return->subusage=6;
			$return->refine=null; //**
		}

		//S.96.04 | PHYSICAL WELL-BEING ACTIVITIES

		if($nace[2]==4){
			$return->subusage=5;
			$return->refine=0; //**
		}

		//S.96.09 | OTHER PERSONAL SERVICE ACTIVITIES

		if($nace[2]==9){
			$return->subusage=5;
			$return->refine=1; //**
		}
	}
}
if($nace[0]=='U'){
	$return->zid=12; //**
	$return->usage=1; //**
	if($nace[1]==99){
		$return->subusage=null; //**
	
		//U.99.00 | ACTIVITIES OF EXTRATERRITORIAL ORGANISATIONS AND BODIES

		if($nace[2]==0){
			$return->refine=null; //**
		}
	}
}

?>

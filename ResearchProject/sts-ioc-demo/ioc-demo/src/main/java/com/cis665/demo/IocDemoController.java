/*******************************************************************
 * 
 * Class:          CIS665
 * Assignment:     Course Project
 * Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
 * Due Date:       5.24.2019 @ 11:59pm
 *
 * Filename:       IocDemoController.java
 *   
 *   REST controller for the IoC demo application.  Receives and
 *   distributes HTTP requests to the processing methods.
 *   
 *******************************************************************/
 
package com.cis665.demo;

import javax.annotation.PostConstruct;

import org.slf4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

import com.cis665.demo.BuildProcessor.IIocBuildProcessor;

// REST based controller for the CIS665 IoC demo application
@RestController
@RequestMapping("/build-processor")
public class IocDemoController {
	@Autowired
	Logger log;
	
	// Define the build processor object reference which is where
	// dependency injection will occur.  If an instance of an
	// IIocBuildProcessor exists within the environment it will
	// be "auto wired" into the 'buildProcessor' variable.
	//
	// @Autowired is an annotation provided by the Spring Boot
	// framework that provides the facilities supporting the
	// use of dependency injection.
	@Autowired
	IIocBuildProcessor buildProcessor;
	
	@PostConstruct
	private void postInit() {
		log.info("Controller has been started...");
	}


	// HTTP Get requests for a 'heartbeat' response are
	// routed to this method for processing.  In this very
	// simple case demonstrating how dependency injection can
	// application development, the heart response from the
	// configured build processor is returned as just a text
	// based message and a status of "OK" is provided in 
	// response.
    @RequestMapping(
            method = RequestMethod.GET,
            value = "/heartbeat",
            produces = MediaType.APPLICATION_JSON_VALUE)
    @ResponseBody
    public HttpStatus heartbeat() throws Exception {
    	buildProcessor.heartBeat();

    	return HttpStatus.OK;
    }
}


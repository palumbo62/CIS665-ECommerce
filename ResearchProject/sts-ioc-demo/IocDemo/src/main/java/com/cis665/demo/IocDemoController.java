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

import java.util.concurrent.atomic.AtomicLong;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

import com.cis665.demo.BuildProcessor.IIocBuildProcessor;

// REST based controller for the CIS665 IoC demo application
@RestController
public class IocDemoController {
    private static final String template = "IocDemo: [%s]";
    private final AtomicLong counter = new AtomicLong();
    
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
	
	// HTTP Get requests for a build-processor 'submit' response are
	// routed to this method for processing.  In this very
	// simple case demonstrating how dependency injection can
	// application development, the 'submit' response from the
	// configured build processor is returned as just a text
	// based message with a time-stamp to signal the request has
	// been processed.
    @RequestMapping(
            method = RequestMethod.POST,
            value = "/BuildResponse")
    @ResponseBody
    public IoCBuildResponse buildProcResponse() throws Exception {
    	return new IoCBuildResponse(counter.incrementAndGet(),
                String.format(template, buildProcessor.submit()));
    }
}

